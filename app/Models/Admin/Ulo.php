<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Config;
use Session;
use DB;

class Ulo extends Model
{
    use HasFactory;

    protected $table = 'tb_trx_ulo';
	// protected $table = 'vw_list_ulo';
    const CREATED_AT = 'created_date';
	const UPDATED_AT = 'updated_date';

    public function view_ulo($id_departemen, $id_izin,$id_jabatan,$is_evaluator = 0,$id_user_session = 0 ){
		$limit_db = Config::get('app.admin.limit');
		// dd($id_izin);
		if ($id_izin != 'EMPTY') {
			$ulo = Ulo::select('vw_list_ulo.id as id_ulo','vw_list_ulo.*')
			
			// ->join('tb_oss_mst_kodestatusizin','tb_trx_ulo.status_ulo','=','tb_oss_mst_kodestatusizin.oss_kode')
			->join('vw_list_ulo',function($join){
				$join->on('tb_trx_ulo.id_izin','=','vw_list_ulo.id_izin');
				$join->on('tb_trx_ulo.id','=','vw_list_ulo.id');
			})
			->where('vw_list_ulo.id','=',$id_izin)
			// ->where('vw_list_ulo.is_active','=','1')
			->with('KodeIzin');
			$ulo = $ulo->first();
			// dd($ulo);
		}else{
			
			$ulo = Ulo::select('vw_list_ulo.*')
			->join('vw_list_ulo',function($join){
				$join->on('tb_trx_ulo.id_izin','=','vw_list_ulo.id_izin');
				$join->on('tb_trx_ulo.id','=','vw_list_ulo.id');
			});
			// ->join('tb_oss_mst_kodestatusizin','tb_trx_ulo.status_ulo','=','tb_oss_mst_kodestatusizin.oss_kode')
			// ->where('vw_list_ulo.is_active','1');
			// dd($id_jabatan);
			if($is_evaluator == 1){
				$ulo = $ulo->join('tb_trx_disposisi_evaluator_ulo as d',function($join){
					$join->on('d.id_izin','=','vw_list_ulo.id_izin');
					$join->on('d.id_ulo','=','vw_list_ulo.id');
				});
				$ulo = $ulo->where('d.id_disposisi_user','=', $id_user_session);
			};
			$ulo = $ulo->with('KodeIzin')->orderBy('updated_date','desc');
			if ($id_jabatan == 2) { //koordinator
				$ulo = $ulo->whereIn('vw_list_ulo.status_ulo',[20,25,903,51])->orderBy('updated_date','desc');
			}else if($id_jabatan == 4){ //evaluator
				$ulo = $ulo->where('vw_list_ulo.status_ulo','=',901)->orderBy('updated_date','desc');
			}else if($id_jabatan == 3){ //subkoordinator
				$ulo = $ulo->whereIn('vw_list_ulo.status_ulo',[902,9021,9023])->orderBy('updated_date','desc');
			}else if($id_jabatan == 1){ //direktur
				$ulo = $ulo->whereIn('vw_list_ulo.status_ulo',[904])
							->where('vw_list_ulo.status_sk_ulo','=',null)
							->orderBy('updated_date','desc');
			}
			// $ulo->orWhere(function ($query) {
			// 	$query->where('vw_list_ulo.is_active', '1')
			// 		->Where('vw_list_ulo.status_survey', 0);
			// });
			// $ulo->Where('vw_list_ulo.status_survey', 0);
			// dd($ulo);
			// });
		}
		// dd($id_jabatan,$ulo);
		return $ulo;
    }

    public function view_ulo_aktif($id_departemen, $id_izin,$id_jabatan,$is_evaluator = 0,$id_user_session = 0 ){
		$limit_db = Config::get('app.admin.limit');
		// dd($id_izin);
		if ($id_izin != 'EMPTY') {
			$ulo = Ulo::select('vw_list_ulo_aktif.id as id_ulo','vw_list_ulo_aktif.*')
			
			// ->join('tb_oss_mst_kodestatusizin','tb_trx_ulo.status_ulo','=','tb_oss_mst_kodestatusizin.oss_kode')
			->join('vw_list_ulo_aktif',function($join){
				$join->on('tb_trx_ulo.id_izin','=','vw_list_ulo_aktif.id_izin');
				$join->on('tb_trx_ulo.id','=','vw_list_ulo_aktif.id');
			})
			->where('vw_list_ulo_aktif.id','=',$id_izin)
			// ->where('vw_list_ulo.is_active','=','1')
			->with('KodeIzin');
			$ulo = $ulo->first();
			// dd($ulo);
		}else{
			
			$ulo = Ulo::select('vw_list_ulo_aktif.*')
			->join('vw_list_ulo_aktif',function($join){
				$join->on('tb_trx_ulo.id_izin','=','vw_list_ulo_aktif.id_izin');
				$join->on('tb_trx_ulo.id','=','vw_list_ulo_aktif.id');
			});

			if($id_departemen == 7){
				$ulo = $ulo->where('vw_list_ulo_aktif.id_master_izin','=',3);
			}elseif($id_departemen == 8){
				$ulo = $ulo->where('vw_list_ulo_aktif.id_master_izin','=',3);
			}elseif($id_departemen == 6){
				$ulo = $ulo->where('vw_list_ulo_aktif.id_master_izin','!=',3);
			}else{
				
				$ulo = $ulo->where('vw_list_ulo_aktif.id_master_izin','!=',3);
			}
			// ->join('tb_oss_mst_kodestatusizin','tb_trx_ulo.status_ulo','=','tb_oss_mst_kodestatusizin.oss_kode')
			// ->where('vw_list_ulo.is_active','1');
			// dd($id_jabatan, $ulo->GET());
			if($is_evaluator == 1){
				$ulo = $ulo->join('tb_trx_disposisi_evaluator_ulo as d',function($join){
					$join->on('d.id_izin','=','vw_list_ulo_aktif.id_izin');
					$join->on('d.id_ulo','=','vw_list_ulo_aktif.id');
				});
				$ulo = $ulo->where('d.id_disposisi_user','=', $id_user_session);
			};
			$ulo = $ulo->with('KodeIzin')->orderBy('updated_date','desc');
			if ($id_jabatan == 2) { //koordinator
				$ulo = $ulo->whereIn('vw_list_ulo_aktif.status_ulo',[20,25,901,903,51])->orderBy('updated_date','desc');
			}else if($id_jabatan == 4){ //evaluator
				$ulo = $ulo->where('vw_list_ulo_aktif.status_ulo','=',901)->orderBy('updated_date','desc');
			}else if($id_jabatan == 3){ //subkoordinator
				$ulo = $ulo->whereIn('vw_list_ulo_aktif.status_ulo',[902,9021,9023])->orderBy('updated_date','desc');
			}else if($id_jabatan == 1){ //direktur
				$ulo = $ulo->whereIn('vw_list_ulo_aktif.status_ulo',[904,9041])
							// ->where('vw_list_ulo_aktif.status_sk_ulo','=',null)
							->orderBy('updated_date','desc');
			}
			// $ulo->orWhere(function ($query) {
			// 	$query->where('vw_list_ulo.is_active', '1')
			// 		->Where('vw_list_ulo.status_survey', 0);
			// });
			// $ulo->Where('vw_list_ulo.status_survey', 0);
			// dd($id_departemen,$ulo->GET());
			// });
		}
		// dd($id_jabatan,$ulo);
		return $ulo;
    }
    public function view_ulo_all(){
		$limit_db = Config::get('app.admin.limit');
		// dd($id_izin);
		$ulo = Ulo::select('tb_trx_ulo.id as id_ulo','tb_trx_ulo.*','vw_list_ulo.*')
			->join('vw_list_ulo','vw_list_ulo.id','=','tb_trx_ulo.id')->get();
		return $ulo;
    }

	public function KodeIzin()
    {
        return $this->belongsTo(KodeIzin::class, 'status_ulo', 'oss_kode');
    }
    /**
     * Get all persyaratan (requirements) for this Ulo.
     */
    public function persyaratan()
    {
        return $this->hasMany(\App\Models\Admin\Persyaratan::class, 'id_trx_izin', 'id_izin');
    }
}
// tb_oss_mst_kodestatusizin