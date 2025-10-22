<?php

namespace App\Http\Controllers;

use Config;
use Session;
use Carbon\Carbon;
use App\Models\Nib;


use App\Models\User;
use App\Models\Proyek;
use App\Models\MstIzin;
use App\Models\Izin_oss;
use App\Models\Admin\Ulo;
use App\Models\DetailNIB;
use App\Models\MstUserBo;
use App\Helpers\LogHelper;
use App\Models\Admin\Izin;
use App\Helpers\DateHelper;
use App\Helpers\EmailHelper;
use Illuminate\Http\Request;

use App\Helpers\CommonHelper;
use App\Models\Admin\Izinlog;
use App\Models\Admin\Izinoss;

use App\Models\MstIzinSyarat;
use App\Helpers\UtilPerizinan;
use App\Models\TrxIzinPrinsip;
use App\Mail\Persyaratan\Pemohon;
use App\Models\Admin\IzinPrinsip;
use PhpParser\Node\Stmt\TryCatch;
use App\Models\TrxPemenuhanSyarat;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Mail\Persyaratan\Koordinator;

class PemenuhanPersyaratanController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth')->except('viewspersyaratan');
    }

    public function index(Request $req)
    {
        $utilizin = new UtilPerizinan();
        $date_reformat = new DateHelper();

        $izin = $utilizin->getIzinpemenuhansyarat(strtoupper($req->izin), 'where');
        $kategori = MstIzin::where('name', strtoupper($req->izin))->first();
        // dd($izin);/
        $tipe = $req->izin;
        return view('pemenuhansyarat.index', compact('tipe', 'izin', 'kategori', 'date_reformat'));
    }

    // public function viewpersyaratan(Request $req, $id)
    // {
    //     $date_reformat = new DateHelper();

    //     $common = new CommonHelper;
    //     $limit_db = Config::get('app.admin.limit');
    //     $izin = Izin::with('persyaratan')->where('id_izin', '=', $id)->first();
    //     if ($izin == null) {
    //         return abort(404);
    //     }
    //     $izinArr = $izin->toArray();
    //     $nib = $izinArr['nib'];
    //     $kd_izin = $izinArr['kd_izin'];

    //     $detailNib = Nib::select('*')->where('nib', '=', $nib)->first();
    //     if (empty($detailNib)) {
    //         $detailNib = array();
    //     } else {
    //         $detailNib->toArray();
    //     }

    //     $map_izin = array();

    //     $mst_kode_izin = DB::table('tb_mst_izinlayanan')->select('id', 'kode_izin', 'name')->where(
    //         'kode_izin',
    //         '=',
    //         $kd_izin
    //     )->first();
    //     $id_mst_izinlayanan = $mst_kode_izin->id;

    //     $map_izin = $common->get_map_izin($id_mst_izinlayanan);

    //     // Use eager loaded persyaratan to fill map_izin
    //     $filled_persyaratan = $izin->persyaratan->toArray();
    //     foreach ($map_izin as $key => $value) {
    //         $map_izin[$key] = $value;
    //         foreach ($filled_persyaratan as $value2) {
    //             if ($value->id == $value2['id_map_listpersyaratan']) {
    //                 $map_izin[$key]->form_isian = $value2['filled_document'];
    //                 $map_izin[$key]->nama_asli = $value2['nama_file_asli'];
    //                 $map_izin[$key]->need_correction = $value2['need_correction'];
    //                 $map_izin[$key]->correction_note = $value2['correction_note'];
    //             }
    //         }
    //     }

    //     $html = array();

    //     $penanggungjawab = array();
    //     $penanggungjawab = $common->get_pj_nib($nib);
    //     $cities = DB::table('tb_mst_kabupaten')->select('id', 'name')->get();
    //     $triger = Session::get('id_mst_jobposition');

    //     return view('layouts.frontend.view-persyaratan', [
    //         'date_reformat' => $date_reformat,
    //         'id' => $id,
    //         'cities' => $cities,
    //         'izin' => $izinArr,
    //         'detailnib' => $detailNib,
    //         'penanggungjawab' => $penanggungjawab,
    //         'map_izin' => $map_izin,
    //         'filled_persyaratan' => $filled_persyaratan,
    //         'triger' => $triger
    //     ]);
    // }
    public function viewpersyaratan(Request $req, $id)
{
    $date_reformat = new DateHelper();

    $common = new CommonHelper;
    $limit_db = Config::get('app.admin.limit');
    $izin = Izin::with('persyaratan')->where('id_izin', '=', $id)->first();
    if ($izin == null) {
        return abort(404);
    }
    $izinArr = $izin->toArray();
    $nib = $izinArr['nib'];
    $kd_izin = $izinArr['kd_izin'];

    $detailNib = Nib::select('*')->where('nib', '=', $nib)->first();
    if (empty($detailNib)) {
        $detailNib = array();
    } else {
        $detailNib->toArray();
    }

    $mst_kode_izin = DB::table('tb_mst_izinlayanan')->select('id', 'kode_izin', 'name')->where(
        'kode_izin',
        '=',
        $kd_izin
    )->first();
    $id_mst_izinlayanan = $mst_kode_izin->id;

    // Refactored: Join map_izin and persyaratan in SQL
    $map_izin = DB::table('tb_map_listpersyaratan as map')
        ->leftJoin('tb_trx_persyaratan as trx', function($join) use ($id) {
            $join->on('map.id', '=', 'trx.id_map_listpersyaratan')
                 ->where('trx.id_trx_izin', '=', $id);
        })
        ->select(
            'map.*',
            'trx.filled_document as form_isian',
            'trx.nama_file_asli as nama_asli',
            'trx.need_correction',
            'trx.correction_note'
        )
        ->where('map.id_mst_izinlayanan', $id_mst_izinlayanan)
        ->get();

    $html = array();

    $penanggungjawab = array();
    $penanggungjawab = $common->get_pj_nib($nib);
    $cities = DB::table('tb_mst_kabupaten')->select('id', 'name')->get();
    $triger = Session::get('id_mst_jobposition');

    return view('layouts.frontend.view-persyaratan', [
        'date_reformat' => $date_reformat,
        'id' => $id,
        'cities' => $cities,
        'izin' => $izinArr,
        'detailnib' => $detailNib,
        'penanggungjawab' => $penanggungjawab,
        'map_izin' => $map_izin,
        'filled_persyaratan' => $filled_persyaratan,
        'triger' => $triger
    ]);
}
    public function formpersyaratan(Request $req, $id)
    {

        // dd($req->all());
        
        $log= new LogHelper();
        $log->createLog('Pemenuhan Persyaratan', $id);
        $id_izin = $id;
        $izin = Izinoss::where('id_izin', $id)
        // ->leftjoin('vw_izinprinsip_pathsk as c', 'c.id_izin_prinsip', '=', 'tb_oss_trx_izin.id_proyek')
        ->first();
        // $datasyarat = MstIzinSyarat::where('kib', $izin->kd_izin)->orderBy('urutan')->get();

        $datasyaratpdf = DB::table('tb_map_listpersyaratan as a')->select('a.is_mandatory', 'a.component_name', 'a.id as id_maplist', 'b.persyaratan', 'b.persyaratan_html', 'b.file_type', 'b.desc', 'a.download_link', 'b.group_by', 'c.kode_izin')
            ->join('tb_mst_listpersyaratan as b', 'b.id', '=', 'a.id_mst_listpersyaratan')
            ->join('tb_mst_izinlayanan as c', 'c.id', '=', 'a.id_mst_izinlayanan')
            ->where('a.is_active', '=', '1')
            // ->where('b.file_type', '=', 'pdf')
            ->where('c.kode_izin', '=', $izin->kd_izin)
            ->orderBy('b.order_group', 'asc')
            ->orderBy('a.order_no', 'asc')
            ->get();

        // $datasyaratpdf2 = DB::table('tb_map_listpersyaratan as a')->select('a.is_mandatory', 'd.is_active', 'b.persyaratan', 'b.file_type', 'b.desc', 'b.download_link', 'b.group_by', 'c.kode_izin')
        //     ->join('tb_mst_listpersyaratan as b', 'b.id', '=', 'a.id_mst_listpersyaratan')
        //     ->join('tb_mst_izinlayanan as c', 'c.id', '=', 'a.id_mst_izinlayanan')
        //     ->join('tb_trx_persyaratan as d', 'd.id_map_listpersyaratan', '=', 'a.id')
        //     ->where('a.is_active', '=', '1')
        //     // ->where('b.file_type', '=', 'pdf')
        //     ->where('c.kode_izin', '=', $izin->kd_izin)
        //     ->orderBy('b.group_by', 'desc')
        //     ->get();

        // $n = 1;
        // foreach($datasyaratpdf2 as $i){
        //     echo "is_active ".$i->is_active." is_mandatory ke ".$n." adalah = ".$i->is_mandatory;
        //     echo "<br>=======================================<br>";
        //     $n++;
        // }


        $datasyarattable = DB::table('tb_map_listpersyaratan as a')->select('b.persyaratan', 'b.persyaratan_html', 'b.file_type', 'b.desc', 'a.download_link')
            ->join('tb_mst_listpersyaratan as b', 'b.id', '=', 'a.id_mst_listpersyaratan')
            ->join('tb_mst_izinlayanan as c', 'c.id', '=', 'a.id_mst_izinlayanan')
            ->where('a.is_active', '=', '1')
            ->where('b.file_type', '=', 'table')
            ->where('c.kode_izin', '=', $izin->kd_izin)
            ->orderby('order_no', 'asc')
            ->get();
        // dd($datasyaratpdf);

        $common = new CommonHelper();
        $detailNib = $common->get_detail_nib_by_oss($izin->oss_id);
        // dd($detailNib);

        $penanggungjawab = array();
        $penanggungjawab = $common->get_pj_nib($detailNib->nib);

        $utilizin = new UtilPerizinan();
        $izin2 = array();
        $izin2 = $utilizin->getizinBtidIzin(strtoupper($izin->id_izin));

        $datenow = Carbon::now();
        $date_reformat = new DateHelper();
        // dd( $detailNib);
        return view('pb.persyaratan', compact('id_izin', 'izin', 'izin2', 'datasyarattable', 'datasyaratpdf', 'detailNib', 'penanggungjawab', 'datenow', 'date_reformat'));
    }

    public function viewspersyaratan($id)
    {

        // dd($id);
        $id_izin = $id;
        $izin = Izinoss::where('id_izin', $id)->first();
        // dd( $izin);
        // $datasyarat = MstIzinSyarat::where('kib', $izin->kd_izin)->orderBy('urutan')->get();

        $datavalidasi = DB::table('vw_validasi as a')
            ->where('a.id_izin', $id)
            ->first();
        // dd( $datavalidasi);

        // $datasyarattable = DB::table('tb_map_listpersyaratan as a')->select('b.persyaratan', 'b.persyaratan_html', 'b.file_type', 'b.desc', 'a.download_link')
        //     ->join('tb_mst_listpersyaratan as b', 'b.id', '=', 'a.id_mst_listpersyaratan')
        //     ->join('tb_mst_izinlayanan as c', 'c.id', '=', 'a.id_mst_izinlayanan')
        //     ->where('a.is_active', '=', '1')
        //     ->where('b.file_type', '=', 'table')
        //     ->where('c.kode_izin', '=', $izin->kd_izin)
        //     ->orderby('order_no', 'asc')
        //     ->get();
        // dd($datasyarattable);

        $common = new CommonHelper();
        $detailNib = $common->get_detail_nib_by_oss($izin->oss_id);
        // dd($detailNib);

        $penanggungjawab = array();
        $penanggungjawab = $common->get_pj_nib($detailNib->nib);

        $utilizin = new UtilPerizinan();
        $izin2 = array();
        $izin2 = $utilizin->getizinBtidIzin(strtoupper($datavalidasi->id_izin));

        $datenow = Carbon::now();
        $date_reformat = new DateHelper();
        // dd($izin, $datavalidasi, $detailNib, $penanggungjawab, $izin2);
        return view('layouts.frontend.validasi-sk', compact('datavalidasi', 'izin', 'izin2', 'detailNib', 'penanggungjawab', 'datenow', 'date_reformat'));
    }

    public function downloadlampiran(Request $req)
    {
        $datasyarat = MstIzinSyarat::find($req->id);
        // dd($datasyarat->file_lampiran);
        return response()->download(storage_path('app/lampiran/' . $datasyarat->file_lampiran));
    }


    public function submitpersyaratan(Request $req)
    {
        // dd($req->all(),$req->id_izin);
        // $this->validate($req, [
        //     'syarat.*' => 'pdf'
        // ]);
        // dump(count($req->file('konfigurasi_teknis')));
        DB::beginTransaction();
        try {
            $insert = array();
                        $validatedData = $req->validate([
                                'syarat' => 'required|array',
                                'syarat.*' => [
                                    'required',
                                    'mimes:pdf',
                                    'mimetypes:application/pdf',
                                    'max:5120', // 5120 KB (5 MB) max size
                                    function ($attribute, $value, $fail) {
                        // $file = $req->file('syarat');
                                        // Custom validation to prevent dangerous extensions like .PhP56
                                        if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                                            $fail('Invalid file extension.');
                                        }
                                    },
                                ],
                            ]);
                if ($req->hasfile('syarat')) {
                    foreach ($req->file('syarat') as $key => $file) {
                            // $file = $req->file('syarat');
                        if (strtolower($file->getClientOriginalExtension()) === 'pdf') {
                                //    $filePath = $file->store('pdfs'); // Store in the 'pdfs' directory
                            $filename = "KOMINFO-" . time() . $key . '.' . $file->extension();
                            $path = $file->storeAs('public/file_syarat', $filename);
                            $name = $file->getClientOriginalExtension();
                            $path = str_replace('public/', 'storage/', $path);
                            // Return success response or proceed with further logic
                            //    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                        }
                        else {
                            // dd('syarat',$file->getClientOriginalExtension());
                            return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                        }
                    // $filename = "KOMINFO-" . time() . $key . '.' . $file->extension();
                    // // $filename = $file->getClientOriginalExtension() . $key . '.' . $file->extension();
                    // $path = $file->storeAs('public/file_syarat', $filename);
                    // $name = $file->getClientOriginalExtension();
                    // $path = str_replace('public/', 'storage/', $path);
                    // dd($req);
                    $insert[] = array(
                        'id_trx_izin' => $req->id_izin,
                        'id_map_listpersyaratan' => $req->id_maplist[$key],
                        'filled_document' => $path,
                        // 'uraian' => $req->persyaratan[$key],
                        // 'jenis_isian' => 'pdf',
                        'nama_file_asli' => $filename,
                        'created_by' => Auth::user()->name,
                        'is_active' => '1'
                    );
                }
            }

            $koreksi_all = 0;
            $common = new CommonHelper;
            $email = new EmailHelper();
            $id_departemen_user = Session::get('id_departemen');
            // dd(Session::get('id_departemen'));
            $departemen = $common->getDepartemen($id_departemen_user);
            $fileUpload = DB::table('tb_trx_persyaratan')->insert($insert);
            $jenis_izin = Izin::where('id_izin', $req->id_izin)->first();
            // dd($jenis_izin);
            $izins = $jenis_izin->toArray();
            $nib = $jenis_izin['nib'];
            $nibs = Nib::where('nib', $nib)->first();
            $nibs = $nibs->toArray();
            $jenis_izin = $jenis_izin->nama_master_izin;
            $id_izin_init = substr($req->id_izin, 0, 3);
            // $mytime = now();
            // $mytime->toDateTimeString();
            // dd(date('Y-m-d H:i:s'));
            // dd(Auth::user()->jenis_pu);
            if (Auth::user()->jenis_pu == 'TKI') {
                if($izins['kd_izin'] == '059000030066'){
                    $izin = Izin_oss::where('id_izin', $req->id_izin)
                    ->update(['status_checklist' => '22', 'submitted_at' => date('Y-m-d H:i:s')]);
                    
                }elseif($izins['kd_izin'] == '059000020066'){
                    $izin = Izin_oss::where('id_izin', $req->id_izin)
                    ->update(['status_checklist' => '23', 'submitted_at' => date('Y-m-d H:i:s')]);
                }elseif($izins['kd_izin'] == '059000040066'){
                    $izin = Izin_oss::where('id_izin', $req->id_izin)
                    ->update(['status_checklist' => '24', 'submitted_at' => date('Y-m-d H:i:s')]);
                }else{
                    $izin = Izin_oss::where('id_izin', $req->id_izin)
                    ->update(['status_checklist' => '21', 'submitted_at' => date('Y-m-d H:i:s')]);
                }
                
            } else {
                $izin = Izin_oss::where('id_izin', $req->id_izin)
                    ->update(['status_checklist' => '20', 'submitted_at' => date('Y-m-d H:i:s')]);
            }


            // insert rencana usaha jika terdapat data rencanausaha
            if (isset($req->cakupanwilayahtelsus_mtk)) {
                $insertPerencanaan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_cakupanwilayahtelsus_mtk,
                    'filled_document' => json_encode($req->cakupanwilayahtelsus_mtk),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rencanausaha = DB::table('tb_trx_persyaratan')->insert($insertPerencanaan);
            }
            if (isset($req->cakupanwilayahtelsus_skrd)) {
                $insertPerencanaan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_cakupanwilayahtelsus_skrd,
                    'filled_document' => json_encode($req->cakupanwilayahtelsus_skrd),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rencanausaha = DB::table('tb_trx_persyaratan')->insert($insertPerencanaan);
            }
            if (isset($req->cakupanwilayahtelsus_skrk)) {
                $insertPerencanaan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_cakupanwilayahtelsus_skrk,
                    'filled_document' => json_encode($req->cakupanwilayahtelsus_skrk),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rencanausaha = DB::table('tb_trx_persyaratan')->insert($insertPerencanaan);
            }
            if (isset($req->cakupanwilayahtelsus_skrt)) {
                $insertPerencanaan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_cakupanwilayahtelsus_skrt,
                    'filled_document' => json_encode($req->cakupanwilayahtelsus_skrt),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rencanausaha = DB::table('tb_trx_persyaratan')->insert($insertPerencanaan);
            }
            if (isset($req->cakupanwilayahtelsus_sks)) {
                $insertPerencanaan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_cakupanwilayahtelsus_sks,
                    'filled_document' => json_encode($req->cakupanwilayahtelsus_sks),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rencanausaha = DB::table('tb_trx_persyaratan')->insert($insertPerencanaan);
            }

            if (isset($req->rencanausaha)) {
                // dd($req->rencanausaha);
                $insertPerencanaan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_rencanausaha,
                    'filled_document' => json_encode($req->rencanausaha),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rencanausaha = DB::table('tb_trx_persyaratan')->insert($insertPerencanaan);
            }

            // // store konfigurasi teknis
            if (isset($req->daftar_perangkat)) {
                // $validatedData = $req->validate([
                //     // 'daftar_perangkat.*.sertifikasi_alat' => 'required|mimes:pdf|mimetypes:application/pdf|max:5120',
                //     'daftar_perangkat.*.foto_perangkat' => 'required|mimes:pdf|mimetypes:application/pdf|max:5120',
                //     'daftar_perangkat.*.foto_sn_perangkat' => 'required|mimes:pdf|mimetypes:application/pdf|max:5120',
                // ]);
                // $daftar_perangkat = [...$req->daftar_perangkat];
                $daftar_perangkat = $req->daftar_perangkat;
                $insertDaftarPerangkat = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_daftar_perangkat,
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                // dd($req->hasFile('foto_perangkat'),$req->daftar_perangkat);
                if (count($req->file('daftar_perangkat'))) {
                    foreach ($req->file('daftar_perangkat') as $key => $file) {
                        if (isset($file['sertifikasi_alat'])) {
                            // $validatedData = $file->validate([
                            //     'sertifikasi_alat' => 'required|mimes:pdf|max:5120', // 2048 KB (2 MB) max size
                            // ]);
                            // $file = $file['sertifikasi_alat'];
                            // $validatedData = $file->validate([
                            //         'daftar_perangkat.' . $key . 'sertifikasi_alat' => [
                            //             'required',
                            //             'mimes:pdf',
                            //             'mimetypes:application/pdf',
                            //             'max:5120', // 5120 KB (5 MB) max size
                            //             function ($attribute, $value, $fail) {
                            //                 // Custom validation to prevent dangerous extensions like .PhP56
                            //                 if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                            //                     $fail('Invalid file extension.');
                            //                 }
                            //             },
                            //         ],
                            //     ]);
                            //     $data_file = $file['sertifikasi_alat'];
                            // if (strtolower($data_file->getClientOriginalExtension()) === 'pdf') {
                            // $filename = "KOMINFO-cert" . time() . $key . '.' . $data_file->extension();
                            //     $path = $data_file->storeAs('public/file_syarat', $filename);
                            //     $path = str_replace('public/', 'storage/', $path);
                            //     $daftar_perangkat[$key]['sertifikasi_alat'] = $path;
                            //     // Return success response or proceed with further logic
                            //     //    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                            // }

                            $sertifikasiAlatFile = $file['sertifikasi_alat'];
                            if (strtolower($sertifikasiAlatFile->getClientOriginalExtension()) === 'pdf') {
                                $req->validate([
                                    "daftar_perangkat.$key.sertifikasi_alat" => 'mimes:pdf|mimetypes:application/pdf|max:5120',
                                ]);
                                $filename = "KOMINFO-cert" . time() . $key . '.' . $sertifikasiAlatFile->extension();
                                $path = $sertifikasiAlatFile->storeAs('public/file_syarat', $filename);
                                $daftar_perangkat[$key]['sertifikasi_alat'] = str_replace('public/', 'storage/', $path);
                            }
                            else {
                            // dd('sertifikasi_alat',$file->getClientOriginalExtension());
                                return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            }
                            // $data_file = $file['sertifikasi_alat'];
                            // $filename = "KOMINFO-cert" . time() . $key . '.' . $data_file->extension();
                            // // $filename = $data_file->getClientOriginalExtension() . $key . '.' . $data_file->extension();
                            // $path = $data_file->storeAs('public/file_syarat', $filename);
                            // $path = str_replace('public/', 'storage/', $path);
                            // $daftar_perangkat[$key]['sertifikasi_alat'] = $path;
                        }
                        if (isset($file['foto_perangkat'])) {
                            
                            // $file = $file['foto_perangkat'];
                            //     $validatedData = $file->validate([
                            //         'daftar_perangkat.' . $key . 'foto_perangkat' => [
                            //             'required',
                            //             'mimes:pdf',
                            //             'mimetypes:application/pdf',
                            //             'max:5120', // 5120 KB (5 MB) max size
                            //             function ($attribute, $value, $fail) {
                            //                 // Custom validation to prevent dangerous extensions like .PhP56
                            //                 if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                            //                     $fail('Invalid file extension.');
                            //                 }
                            //             },
                            //         ],
                            //     ]);
                            // $data_file_foto = $file['foto_perangkat'];
                            // if (strtolower($data_file_foto->getClientOriginalExtension()) === 'pdf') {
                            //     $filename_foto = "KOMINFO-foto" . time() . $key . '.' . $data_file_foto->extension();
                            //     // $filename_foto = $data_file_foto->getClientOriginalExtension() . $key . '.' . $data_file_foto->extension();
                            //     $path_foto = $data_file_foto->storeAs('public/file_syarat', $filename_foto);
                            //     $path_foto = str_replace('public/', 'storage/', $path_foto);
                            //     $daftar_perangkat[$key]['foto_perangkat'] = $path_foto;
                            //     // Return success response or proceed with further logic
                            //     //    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                            // }
                            $fotoPerangkatFile = $file['foto_perangkat'];
                            if (strtolower($fotoPerangkatFile->getClientOriginalExtension()) === 'pdf') {
                                $req->validate([
                                    "daftar_perangkat.$key.foto_perangkat" => 'mimes:pdf|mimetypes:application/pdf|max:5120',
                                ]);
                                $filename_foto = "KOMINFO-foto" . time() . $key . '.' . $fotoPerangkatFile->extension();
                                $path_foto = $fotoPerangkatFile->storeAs('public/file_syarat', $filename_foto);
                                $daftar_perangkat[$key]['foto_perangkat'] = str_replace('public/', 'storage/', $path_foto);
                            }
                            else {
                            // dd('foto_perangkat',$file->getClientOriginalExtension());
                                return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            }
                            // $data_file = $file['sertifikasi_alat'];
                            // $filename = "KOMINFO-cert" . time() . $key . '.' . $data_file->extension();
                            // // $filename = $data_file->getClientOriginalExtension() . $key . '.' . $data_file->extension();
                            // $path = $data_file->storeAs('public/file_syarat', $filename);
                            // $path = str_replace('public/', 'storage/', $path);
                            // $daftar_perangkat[$key]['sertifikasi_alat'] = $path;
                        }
                        if (isset($file['foto_sn_perangkat'])) {
                            
                            // $file = $file['foto_sn_perangkat'];
                            // $validatedData = $file->validate([
                            //         'daftar_perangkat.' . $key . 'foto_sn_perangkat' => [
                            //             'required',
                            //             'mimes:pdf',
                            //             'mimetypes:application/pdf',
                            //             'max:5120', // 5120 KB (5 MB) max size
                            //             function ($attribute, $value, $fail) {
                            //                 // Custom validation to prevent dangerous extensions like .PhP56
                            //                 if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                            //                     $fail('Format File yang diupload tidak sesuai ketentuan.');
                            //                 }
                            //             },
                            //         ],
                            //     ]);
                            //     $data_file_foto_sn = $file['foto_sn_perangkat'];
                            // if (strtolower($data_file_foto_sn->getClientOriginalExtension()) === 'pdf') {
                            //     $filename_foto_sn = "KOMINFO-foto-sn" . time() . $key . '.' . $data_file_foto_sn->extension();
                            //     // $filename_foto_sn = $data_file_foto_sn->getClientOriginalExtension() . $key . '.' . $data_file_foto_sn->extension();
                            //     $path_foto_sn = $data_file_foto_sn->storeAs('public/file_syarat', $filename_foto_sn);
                            //     $path_foto_sn = str_replace('public/', 'storage/', $path_foto_sn);
                            //     $daftar_perangkat[$key]['foto_sn_perangkat'] = $path_foto_sn;
                            //     // Return success response or proceed with further logic
                            //     //    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                            // }
                            $fotoSnPerangkatFile = $file['foto_sn_perangkat'];
                            if ($fotoSnPerangkatFile->getClientOriginalExtension() === 'pdf') {
                                $req->validate([
                                    "daftar_perangkat.$key.foto_sn_perangkat" => 'mimes:pdf|mimetypes:application/pdf|max:5120',
                                ]);
                                $filename_foto_sn = "KOMINFO-foto-sn" . time() . $key . '.' . $fotoSnPerangkatFile->extension();
                                $path_foto_sn = $fotoSnPerangkatFile->storeAs('public/file_syarat', $filename_foto_sn);
                                $daftar_perangkat[$key]['foto_sn_perangkat'] = str_replace('public/', 'storage/', $path_foto_sn);
                            }
                            else {
                            // dd('foto_sn_perangkat',$file->getClientOriginalExtension());
                                return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            }
                            // $data_file = $file['sertifikasi_alat'];
                            // $filename = "KOMINFO-cert" . time() . $key . '.' . $data_file->extension();
                            // // $filename = $data_file->getClientOriginalExtension() . $key . '.' . $data_file->extension();
                            // $path = $data_file->storeAs('public/file_syarat', $filename);
                            // $path = str_replace('public/', 'storage/', $path);
                            // $daftar_perangkat[$key]['sertifikasi_alat'] = $path;
                        }
                        

                        
                    }
                }
                $insertDaftarPerangkat['filled_document'] = json_encode($daftar_perangkat);
                // dd($insertDaftarPerangkat);
                $daftar_perangkat = DB::table('tb_trx_persyaratan')->insert($insertDaftarPerangkat);
            }
            // // die;
            if (isset($req->daftar_perangkat_telsus)) {
                $daftar_perangkat_telsus = $req->daftar_perangkat_telsus;
                $insertDaftarPerangkatTelsus = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_daftar_perangkat_telsus,
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                // if(count($req->file('daftar_perangkat_telsus'))) {
                //     foreach($req->file('daftar_perangkat_telsus') as $key => $file) {
                //         $data_file = $file['sertifikasi_alat'];
                //         $data_file_foto = $file['foto_perangkat'];
                //         $filename = "KOMINFO-" . time() . $key . '.' . $data_file->extension();
                //         $filename_foto = "KOMINFO-foto" . time() . $key . '.' . $data_file_foto->extension();
                //         $path = $data_file->storeAs('public/file_syarat', $filename);
                //         $path_foto = $data_file_foto->storeAs('public/file_syarat', $filename_foto);
                //         $path = str_replace('public/', 'storage/', $path);
                //         $path_foto = str_replace('public/', 'storage/', $path_foto);
                //         $daftar_perangkat_telsus[$key]['sertifikasi_alat'] = $path;
                //         $daftar_perangkat_telsus[$key]['foto_perangkat'] = $path_foto;
                //         $insertDaftarPerangkatTelsus['filled_document'] = json_encode($daftar_perangkat_telsus);
                //     }
                if (count($req->file('daftar_perangkat_telsus'))) {
                    foreach ($req->file('daftar_perangkat_telsus') as $key => $file) {
                        if (isset($file['sertifikasi_alat'])) {
                            
                            // $file = $file['sertifikasi_alat'];
                            //     $validatedData = $file->validate([
                            //         'daftar_perangkat_telsus.' . $key . 'sertifikasi_alat' => [
                            //             'required',
                            //             'mimes:pdf',
                            //             'mimetypes:application/pdf',
                            //             'max:5120', // 5120 KB (5 MB) max size
                            //             function ($attribute, $value, $fail) {
                            //                 // Custom validation to prevent dangerous extensions like .PhP56
                            //                 if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                            //                     $fail('Format File yang diupload tidak sesuai ketentuan.');
                            //                 }
                            //             },
                            //         ],
                            //     ]);
                            $sertifikasiAlatFile = $file['sertifikasi_alat'];
                                if (strtolower($sertifikasiAlatFile->getClientOriginalExtension()) === 'pdf') {
                                $req->validate([
                                    "daftar_perangkat_telsus.$key.sertifikasi_alat" => 'mimes:pdf|mimetypes:application/pdf|max:5120',
                                ]);
                                $filename = "KOMINFO-cert" . time() . $key . '.' . $sertifikasiAlatFile->extension();
                                $path = $sertifikasiAlatFile->storeAs('public/file_syarat', $filename);
                                $path = str_replace('public/', 'storage/', $path);
                                $daftar_perangkat_telsus[$key]['sertifikasi_alat'] = $path;// Return success response or proceed with further logic
                                //    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                            }
                            else {
                            // dd('sertifikasi_alat2',$file->getClientOriginalExtension());
                                return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            }
                        }
                        if (isset($file['foto_perangkat'])) {
                            
                            // $file = $file['foto_perangkat'];
                            
                            //     $validatedData = $file->validate([
                            //         'daftar_perangkat_telsus.' . $key . 'foto_perangkat' => [
                            //             'required',
                            //             'mimes:pdf',
                            //             'mimetypes:application/pdf',
                            //             'max:5120', // 5120 KB (5 MB) max size
                            //             function ($attribute, $value, $fail) {
                            //                 // Custom validation to prevent dangerous extensions like .PhP56
                            //                 if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                            //                     $fail('Format File yang diupload tidak sesuai ketentuan.');
                            //                 }
                            //             },
                            //         ],
                            //     ]);
                            // if ($validatedData) {
                            //     $data_file = $file['sertifikasi_alat'];
                            //     $filename = "KOMINFO-cert" . time() . $key . '.' . $data_file->extension();
                            //     $path = $data_file->storeAs('public/file_syarat', $filename);
                            //     $path = str_replace('public/', 'storage/', $path);
                            //     $daftar_perangkat_telsus[$key]['sertifikasi_alat'] = $path;// Return success response or proceed with further logic
                            //     //    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                            // }
                            // else {
                            //     return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            // }
                            $fotoPerangkatFile = $file['foto_perangkat'];
                            if (strtolower($fotoPerangkatFile->getClientOriginalExtension()) === 'pdf') {
                                $req->validate([
                                    "daftar_perangkat_telsus.$key.foto_perangkat" => 'mimes:pdf|mimetypes:application/pdf|max:5120',
                                ]);
                                $filename_foto = "KOMINFO-foto" . time() . $key . '.' . $fotoPerangkatFile->extension();
                                $path_foto = $fotoPerangkatFile->storeAs('public/file_syarat', $filename_foto);
                                $path_foto = str_replace('public/', 'storage/', $path_foto);
                                $daftar_perangkat_telsus[$key]['foto_perangkat'] = $path_foto;//    return response()->json(['message' => 'File uploaded successfully', 'path' => $filePath]);
                            }
                            else {
                            // dd('foto_perangkat2',$file->getClientOriginalExtension());
                                return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            }
                        }
                        if (isset($file['foto_sn_perangkat'])) {
                            
                            // $file = $file['foto_sn_perangkat'];
                            //     $validatedData = $file->validate([
                            //         'daftar_perangkat_telsus.' . $key . 'foto_sn_perangkat' => [
                            //             'required',
                            //             'mimes:pdf',
                            //             'mimetypes:application/pdf',
                            //             'max:5120', // 5120 KB (5 MB) max size
                            //             function ($attribute, $value, $fail) {
                            //                 // Custom validation to prevent dangerous extensions like .PhP56
                            //                 if (preg_match('/\.php[0-9]*$/i', $value->getClientOriginalExtension())) {
                            //                     $fail('Invalid file extension.');
                            //                 }
                            //             },
                            //         ],
                            //     ]);
                                $fotoSnPerangkatFile = $file['foto_sn_perangkat'];
                            if (strtolower($fotoSnPerangkatFile->getClientOriginalExtension()) === 'pdf') {
                                $req->validate([
                                    "daftar_perangkat_telsus.$key.foto_sn_perangkat" => 'mimes:pdf|mimetypes:application/pdf|max:5120',
                                ]);
                                $filename_foto_sn = "KOMINFO-foto-sn" . time() . $key . '.' . $fotoSnPerangkatFile->extension();
                                $path_foto_sn = $fotoSnPerangkatFile->storeAs('public/file_syarat', $filename_foto_sn);
                                $path_foto_sn = str_replace('public/', 'storage/', $path_foto_sn);
                                $daftar_perangkat_telsus[$key]['foto_sn_perangkat'] = $path_foto_sn;
                            }
                            else {
                            // dd('foto_sn_perangkat2',$file->getClientOriginalExtension());
                                return redirect('/')->with('message', 'Format File yang diupload tidak sesuai ketentuan.');
                            }
                        }

                    }
                }
                $insertDaftarPerangkatTelsus['filled_document'] = json_encode($daftar_perangkat_telsus);
                // dd($insertDaftarPerangkatTelsus);
                $daftar_perangkat_telsus = DB::table('tb_trx_persyaratan')->insert($insertDaftarPerangkatTelsus);
                // }
            }
            if (isset($req->daftar_ket_konfigurasiteknis)) {
                $daftar_ket_konfigurasiteknis = $req->daftar_ket_konfigurasiteknis;
                $insertDaftarKetKonfigurasiTeknis = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_daftar_ket_konfigurasiteknis,
                    'filled_document' => json_encode($req->daftar_ket_konfigurasiteknis),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                // if(count($req->file('daftar_ket_konfigurasiteknis'))) {
                //     foreach($req->file('daftar_ket_konfigurasiteknis') as $key => $file) {
                //         $data_file = $file['sertifikasi_alat'];
                //         $data_file_foto = $file['foto_perangkat'];
                //         $filename = "KOMINFO-" . time() . $key . '.' . $data_file->extension();
                //         $filename_foto = "KOMINFO-foto" . time() . $key . '.' . $data_file_foto->extension();
                //         $path = $data_file->storeAs('public/file_syarat', $filename);
                //         $path_foto = $data_file_foto->storeAs('public/file_syarat', $filename_foto);
                //         $path = str_replace('public/', 'storage/', $path);
                //         $path_foto = str_replace('public/', 'storage/', $path_foto);
                //         $daftar_ket_konfigurasiteknis[$key]['sertifikasi_alat'] = $path;
                //         $daftar_ket_konfigurasiteknis[$key]['foto_perangkat'] = $path_foto;
                //         $insertDaftarKetKonfigurasiTeknis['filled_document'] = json_encode($daftar_ket_konfigurasiteknis);
                //     }
                // dd($insertKonfigurasiTeknis);
                $daftar_ket_konfigurasiteknis = DB::table('tb_trx_persyaratan')->insert($insertDaftarKetKonfigurasiTeknis);
                // }
            }

            // // store rolloutplan
            if (isset($req->rolloutplan)) {
                $insertRollOutPlan = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_roll_out_plan,
                    'filled_document' => json_encode($req->rolloutplan),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $rolloutplan = DB::table('tb_trx_persyaratan')->insert($insertRollOutPlan);
            }

            // // store komitmen layanan 5 tahun
            if (isset($req->komitmen_kinerja_layanan_lima_tahun)) {
                $insertKomitmenLayananLimaTahun = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => $req->id_maplist_komitmen_kinerja_layanan_lima_tahun,
                    'filled_document' => json_encode($req->komitmen_kinerja_layanan_lima_tahun),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $komitmenlayananlimatahun = DB::table('tb_trx_persyaratan')->insert($insertKomitmenLayananLimaTahun);
            }

            if (isset($req->integration)) {
                $insertIntegration = [
                    'id_trx_izin' => $req->id_izin,
                    'id_map_listpersyaratan' => '99',
                    'filled_document' => json_encode($req->integration),
                    'nama_file_asli' => null,
                    'created_by' => Auth::user()->name,
                    'is_active' => '1'
                ];
                $Integration = DB::table('tb_trx_persyaratan')->insert($insertIntegration);
            }

            if (isset($req->id_maplist_integration)) {
                foreach ($req->id_maplist_integration as $key => $val) {
                    $insertInregration = array(
                        'id_trx_izin' => $req->id_izin,
                        'id_map_listpersyaratan' => $val,
                        'filled_document' => $req->integration[$key],
                        'created_by' => Auth::user()->name,
                        'is_active' => '1'
                    );

                    DB::table('tb_trx_persyaratan')->insert($insertInregration);
                }
            }

            // dd($id_departemen_user);

            //penanggungjawab dan kirim email
            $penanggungjawab = array();
            $email_data = array();
            $email_data_koordinator = array();
            $penanggungjawab = $common->get_pj_nib($nib);
            $catatan_hasil_evaluasi = '';
            $datenow = Carbon::now();
            $date = new DateHelper();
            $date = $date->dateday_lang_reformat_long($datenow);
            // dd($date);

            // dd($penanggungjawab);

            $email_jenis = 'pemenuhan-syarat';
            $nama2 = '';
            // $jenis_izin = Izin::where('id_izin', $req->id_izin)->first();
            // // dd($jenis_izin);
            $izins = Izin::where('id_izin', $req->id_izin)->first();
            
            // dd($izins);
            // dd($penanggungjawab,$email_jenis,$izins,$departemen,$catatan_hasil_evaluasi,$nama2,$nibs,$koreksi_all);
            $kirim_email = $email->kirim_email($penanggungjawab, $email_jenis, $izins, $departemen, $catatan_hasil_evaluasi, $nama2, $nibs, $koreksi_all);
            //end penganggungjawab

            //kirim email koordinator
            if ($jenis_izin == 'TELSUS' || $jenis_izin == 'TELSUS_INSTANSI') {
                $id_departemen_user = 3;
            } elseif ($jenis_izin == 'JASA') {
                $id_departemen_user = 1;
            } elseif ($jenis_izin == 'JARINGAN') {
                $id_departemen_user = 2;
            }
            // dd($jenis_izin);
            $koordinator = $common->get_koordinator_first($id_departemen_user);
            $jabatan = DB::table('tb_mst_jobposition')->where('id', $koordinator->id_mst_jobposition)->first();

            $user['email'] = isset($koordinator->email) ? $koordinator->email : '';
            $user['nama'] = $koordinator->nama;
            $nama2 = $koordinator->nama;
            $email_jenis = 'koordinator-syarat';
            $catatan_hasil_evaluasi = '';
            // dd($user,$email_jenis,$izins,$departemen,$catatan_hasil_evaluasi,$nama2,$nibs,$koreksi_all,$jabatan);
            //end mengirim email ke koordinator
            $kirim_email2 = $email->kirim_email2($user, $email_jenis, $izins, $departemen, $catatan_hasil_evaluasi, $nama2, $nibs, $koreksi_all, $jabatan);

            
            $log= new LogHelper();
            $log->createLog('Kirim Persyaratan', $req->id_izin);

            if ($izin) {

                $Izinoss = Izinoss::where('id_izin', '=', $req->id_izin)->first(); //set status checklist telah didisposisi
                // $User = User::where('id_izin','=',$req->id_izin)->first(); //set status checklist telah didisposisi

                $izinToLog = $Izinoss->toArray();

                unset($izinToLog['created_at']);
                unset($izinToLog['updated_at']);
                unset($izinToLog['id']);
                unset($izinToLog['status_checklist']);


                if (Auth::user()->jenis_pu == 'TKI') {
                    if($izins['kd_izin'] == '059000010066'){
                        $izinToLog['status_checklist'] = '01';
                    }elseif($izins['kd_izin'] == '059000030066'){
                        $izinToLog['status_checklist'] = '02';
                    }elseif($izins['kd_izin'] == '059000020066'){
                        $izinToLog['status_checklist'] = '03';
                    }elseif($izins['kd_izin'] == '059000040066'){
                        $izinToLog['status_checklist'] = '04';
                    }else{
                    $izinToLog['status_checklist'] = '04';}
                } else {
                    $izinToLog['status_checklist'] = '00';
                }
                $izinToLog['created_by'] = Auth::user()->email;
                $izinToLog['created_name'] = Auth::user()->name;
                // dd($izinToLog);
                $insertIzinLog = Izinlog::create($izinToLog);
                DB::commit();
                return redirect()->route('permohonan', $jenis_izin)->with('message', 'Pemenuhan Persyyaratan telah berhasil di kirim, mohon menunggu proses verifikasi persyaratan.');
            }
        } catch (\Exception $e) {
            // dd($e);
            DB::rollback();
            // throw ValidationException::withMessages(['message' => 'Gagal']);
            session()->flash('message', $e->getMessage());
            return redirect()->route('permohonan', $jenis_izin)->with('message', $e->getMessage());
        }
    }

    public function submitpersyaratanip(Request $req)
    {
        // dd($req->all());
        $oss_id = Auth::user()->oss_id;

        $maxId = DB::table('tb_oss_trx_izin')->where('id_izin', 'LIKE', substr($oss_id, 0, 3) . '%')->get()->count();

        if ($maxId > 0) {
            $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", $maxId + 1);
        } else {
            $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", 1);
        }

        $oss_nib = DB::table('tb_oss_nib')->select('*')->where('oss_id', $oss_id)->first();

        // dd($oss_nib);

        $kbli = DB::table('tb_mst_kbli')->select('*')->where('id', $req->kbli)->first();

        if (isset($req->jenislayanan)) {
            $izin_layanan =
                DB::table('tb_mst_izinlayanan')->select('*')->where('id', $req->jenislayanan)->first();
        } else {
            $izin_layanan =
                DB::table('tb_mst_izinlayanan')->select('*')->where('id', $req->jenislayanan_nomor)->first();
        }
        // dd($izin_layanan);

        if ($req->perizinan == 'telsus') {
            $jenis_izin = '02';
            $msg_success = 'Permohonan sudah berhasil disimpan, silahkan lakukan
            pemenuhan persyaratan';
            $msg_failed = 'Mohon maaf permohonan perizinan tidak dapat diajukan, karena terdapat permohonan yang masih
            belum selesai dengan jenis layanan yang sama';
        } elseif ($req->perizinan == 'jasa') {
            $jenis_izin = '02';
            $msg_success = 'Permohonan sudah berhasil disimpan, silahkan lakukan
            pemenuhan persyaratan';
            $msg_failed = 'Mohon maaf permohonan perizinan tidak dapat diajukan, karena terdapat permohonan yang masih
            belum selesai dengan jenis layanan yang sama';
        } elseif ($req->perizinan == 'jaringan') {
            $jenis_izin = '02';
            $msg_success = 'Permohonan sudah berhasil disimpan, silahkan lakukan
            pemenuhan persyaratan';
            $msg_failed = 'Mohon maaf permohonan perizinan tidak dapat diajukan, karena terdapat permohonan yang masih
            belum selesai dengan jenis layanan yang sama';
        } else {
            $jenis_izin = 'K03';
            $msg_success = 'Permohonan sudah berhasil disimpan, silahkan lakukan
            permohonan kode akses';
            $msg_failed = 'Mohon maaf permohonan penomoran tidak dapat diajukan, karena terdapat permohonan yang masih
            belum selesai dengan jenis permohonan kode akses yang sama';
        }

        $cek_openstatusizin = DB::table('tb_oss_trx_izin')->select('*')
            ->where('oss_id', $oss_id)
            ->where('kd_izin', $izin_layanan->kode_izin)
            ->whereNotIn('status_checklist', ['50', '90', '51'])
            ->get();
        $cek_openstatusizin_nomor = DB::table('tb_oss_trx_izin')->select('*')
            ->where('oss_id', $oss_id)
            ->where('kd_izin', $izin_layanan->kode_izin)
            ->whereIn('status_checklist', ['50', '51'])
            ->get();
        // dd($cek_openstatusizin->count());
        if ($cek_openstatusizin->count() > 0) {
            if ($cek_openstatusizin_nomor->count() > 0) {
                $insert = new Izinoss([
                    'oss_id' => $oss_id,
                    'nib' => $oss_nib->nib,
                    'id_izin' => $maxId,
                    'jenis_izin' => $jenis_izin,
                    'kd_daerah' => $oss_nib->perseroan_daerah_id,
                    'kd_izin' => $izin_layanan->kode_izin,
                    'status_checklist' => '00',
                ]);

                $insert->save();

                return redirect('/')->with('message', $msg_success);
            } else {
                return redirect('/')->with('message', $msg_failed);
            }
        } else {
            $insert = new Izinoss([
                'oss_id' => $oss_id,
                'nib' => $oss_nib->nib,
                'id_izin' => $maxId,
                'jenis_izin' => $jenis_izin,
                'kd_daerah' => $oss_nib->perseroan_daerah_id,
                'kd_izin' => $izin_layanan->kode_izin,
                'status_checklist' => '00',
            ]);


            $insert->save();
            
            $log= new LogHelper();
            $log->createLog('Pengajuan Permohonan', $maxId);
            return redirect('/')->with('message', $msg_success);
        }
    }

    public function submitpersyarataniptelsus()
    {
        $oss_id = Auth::user()->oss_id;

        $maxId = DB::table('tb_oss_trx_izin')->where('id_izin', 'LIKE', substr($oss_id, 0, 3) . '%')->get()->count();

        if ($maxId > 0) {
            $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", $maxId + 1);
        } else {
            $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", 1);
        }

        $oss_nib = DB::table('tb_oss_nib')->select('*')->where('oss_id', $oss_id)->first();

        // dd($oss_nib);

        $kbli = DB::table('tb_mst_kbli')->select('*')->where('id', '=', '14')->first();

        $izin_layanan = DB::table('tb_mst_izinlayanan')->select('*')->where('id', '=', '30')->first();

        $jenis_izin = 'K02';


        $insert = new Izinoss([
            'oss_id' => $oss_id,
            'id_izin' => $maxId,
            'id_proyek' => $maxId,
            'jenis_izin' => $jenis_izin,
            'kd_daerah' => $oss_nib->perseroan_daerah_id,
            'kd_izin' => $izin_layanan->kode_izin,
            'status_checklist' => '01',
        ]);


        $insert->save();
            $log= new LogHelper();
            $log->createLog('Pengajuan Permohonan', $maxId);
        return redirect('/')->with('message', 'Permohonan sudah berhasil disimpan, silahkan lakukan
        pemenuhan persyaratan');
    }

    public function submitperpanjanganiptelsus($id)
    {   
        $oss_id = Auth::user()->oss_id;
        $email = new EmailHelper();
        $common = new CommonHelper();
        $IzinPrinsip = TrxIzinPrinsip::where('id_trx_izin', '=', $id)->where('iterasi_perpanjangan', '=', 0)->first();
        $IzinPrinsip_count = TrxIzinPrinsip::where('id_trx_izin', '=', $id)->where('iterasi_perpanjangan', '=', 0)->get();
        // dd($IzinPrinsip_count->get()->count());
        if ($IzinPrinsip_count->count() == 0) {
            return redirect('/')->with('message', 'Mohon maaf, pengajuan perpanjangan izin prinsip Anda tidak
            dapat diajukan. Izin Prinsip telah diperpanjang sebelumnya.');
        } else {
            $maxId = DB::table('tb_oss_trx_izin')->where('id_izin', 'LIKE', substr($oss_id, 0, 3) . '%')->get()->count();

            if ($maxId > 0) {
                $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", $maxId + 1);
            } else {
                $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", 1);
            }
        
            $oss_nib = DB::table('tb_oss_nib')->select('*')->where('oss_id', $oss_id)->first();
        
            // dd($oss_nib);
        
            $kbli = DB::table('tb_mst_kbli')->select('*')->where('id', '=', '14')->first();
        
            $izin_layanan = DB::table('tb_mst_izinlayanan')->select('*')->where('id', '=', '49')->first();
            // dd($izin_layanan);
            $jenis_izin = 'K02';
        
            // $pre_izinprinsip = Izinoss::select('*')->where('id_izin','=',$id)->first();
            // $pre_izinprinsip->iterasi_perpanjangan = 1;
            // $pre_izinprinsip->updated_date = date('Y-m-d H:i:s');
            // $pre_izinprinsip->save();
            // dd($id);
            $insert = new Izinoss([
                'oss_id' => $oss_id,
                'id_izin' => $maxId,
                'jenis_izin' => $jenis_izin,
                'kd_daerah' => $oss_nib->perseroan_daerah_id,
                'kd_izin' => $izin_layanan->kode_izin,
                'status_checklist' => '02',
                // 'id_produk' => $id,
                'id_proyek' => $id,
            ]);
        
        
            $insert->save();

            // $maxNoUlo = Ulo::where('nomor_sklo', 'LIKE', '%TEL.03.%')->get()->count();
            // $maxno = $maxNoUlo + $IzinPrinsip->count();
            // if ($maxno > 0) {
            //     $maxId = sprintf("%04s", $maxno + 1) . '/Tel.03.03/' . date('Y');
            // } else {
            //     $maxId = sprintf("%04s", 1) . '/Tel.03.03/' . date('Y');
            // }
            // DB::beginTransaction();
            // // try {
            // $IzinPrinsip->iterasi_perpanjangan = 1;
            // $IzinPrinsip->updated_date = date('Y-m-d H:i:s');
            // $IzinPrinsip->updated_by = Auth::user()->name;
            // $IzinPrinsip->no_izin_prinsip_extend = $maxId;

            // $IzinPrinsip->save();
            // $id_departemen_user = Session::get('id_departemen');
            // $departemen = $common->getDepartemen($id_departemen_user);
            // $IzinPrinsip_vw = IzinPrinsip::where('id_trx_izin', '=', $id)->first();
            // // $IzinPrinsip->tgl_berlaku = $IzinPrinsip_vw['nib'] . Carbon::now()->addYear()->format('Y');
            // $nibs = Nib::where('nib', $IzinPrinsip_vw['nib'])->first();
            // $penanggungjawab = array();
            // $penanggungjawab = $common->get_pj_nib($IzinPrinsip_vw['nib']);
            // $catatan_hasil_evaluasi = '';
            // $nama2 = '';
            // $email_jenis = 'perpanjangan_ip';
            // $kirim_email =
            //     $email->kirim_email($penanggungjawab, $email_jenis, $IzinPrinsip_vw, $departemen, $catatan_hasil_evaluasi, $nama2, $nibs);
                
            $log= new LogHelper();
            $log->createLog('Pemenuhan Persyaratan Perpanjangan Izin Prinsip', $maxId);
            DB::commit();

            return redirect('/')->with('message', 'Perpanjangan Izin Prinsip telah berhasil dilakukan, Mohon mengajukan persyaratan perpanjangan Izin Prinsip.');
            // } catch (\Throwable $th) {
            //     //throw $th;
            // }


        }
    }

    public function submitpersyaratanizintelsus($id)
    {

        $oss_id = Auth::user()->oss_id;

        $check_izin = DB::table('tb_oss_trx_izin')
            ->where('oss_id', '=', $oss_id)
            ->where('kd_izin','=','059000020066')
            ->whereNotIn('status_checklist',[90,51,50])
            ->get()->count();
        if($check_izin>0){
            return redirect('/')->with('message', 'Mohon maaf, Uji Laik Operasi sedang/sudah diajukan.');
        }else{
            $maxId = DB::table('tb_oss_trx_izin')->where('id_izin', 'LIKE', substr($oss_id, 0, 3) . '%')->get()->count();

            if ($maxId > 0) {
                $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", $maxId + 1);
            } else {
                $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", 1);
            }
        
            $oss_nib = DB::table('tb_oss_nib')->select('*')->where('oss_id', $oss_id)->first();
        
            // dd($oss_nib);
        
            $kbli = DB::table('tb_mst_kbli')->select('*')->where('id', '=', '14')->first();
        
            $izin_layanan = DB::table('tb_mst_izinlayanan')->select('*')->where('id', '=', '47')->first();
        
            $jenis_izin = 'K02';

            $parentizin = Izinoss::select('*')->where('id_izin','=',$id)->first();
            // dd($parentizin['id_proyek']);
        
            $insert = new Izinoss([
                'oss_id' => $oss_id,
                'id_izin' => $maxId,
                'jenis_izin' => $jenis_izin,
                'kd_daerah' => $oss_nib->perseroan_daerah_id,
                'kd_izin' => $izin_layanan->kode_izin,
                'status_checklist' => '03',
                'id_proyek' => $parentizin['id_proyek'],
            ]);
        
        
            $insert->save();
            $log= new LogHelper();
            $log->createLog('Pemenuhan Uji Laik Operasi Izin Prinsip', $maxId);
        
            return redirect('/')->with('message', 'Permohonan baru berhasil ditambahkan, silahkan lakukan pemenuhan persyaratan');
        }

        
    }

    public function submitpersyaratanizintelsus_return($id)
    {

        $parentizin = Izinoss::select('*')->where('id_izin','=',$id)->first();
        $check_izinprinsip = DB::table('vw_izinprinsip_derivative')->select('*')
        ->where('id_izin_prinsip','=',$parentizin['id_proyek'])->first();

        // dd($check_izinprinsip->tgl_izin_prinsip_init);

        if (isset($check_izinprinsip->sk_izin_penyelenggaraan)) {
            $notallowed = 1;
            return redirect('/')->with('message', 'Pengembalian Izin Prinsip tidak dapat diajukkan, karena SK Izin Penyelenggaraan telah terbit');
        } elseif (isset($check_izinprinsip->id_izin_prinsip_ulo)) {
            $notallowed = 1;
            return redirect('/')->with('message', 'Pengembalian Izin Prinsip tidak dapat diajukkan, karena Izin Penyelenggaraan telah diajukan');
        } else {
            $oss_id = Auth::user()->oss_id;

            // $check_izin = DB::table('tb_oss_trx_izin')
            // ->where('oss_id', '=', $oss_id)
            // ->where('kd_izin','=','059000020066')
            // ->whereNotIn('status_checklist',[90,51,50])
            // ->get()->count();
            // if($check_izin>0){
            // return redirect('/')->with('message', 'Mohon maaf, Uji Laik Operasi sedang/sudah diajukan.');
            // }else{
            $maxId = DB::table('tb_oss_trx_izin')->where('id_izin', 'LIKE', substr($oss_id, 0, 3) . '%')->get()->count();

            if ($maxId > 0) {
            $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", $maxId + 1);
            } else {
            $maxId = substr($oss_id, 0, 3) . '-' . date('Ymd') . sprintf("%05s", 1);
            }

            $oss_nib = DB::table('tb_oss_nib')->select('*')->where('oss_id', $oss_id)->first();

            // dd($oss_nib);

            $kbli = DB::table('tb_mst_kbli')->select('*')->where('id', '=', '14')->first();

            $izin_layanan = DB::table('tb_mst_izinlayanan')->select('*')->where('id', '=', '50')->first();

            $jenis_izin = 'K02';

            // $parentizin = Izinoss::select('*')->where('id_izin','=',$id)->first();
            // dd($parentizin['id_proyek']);

            $insert = new Izinoss([
            'oss_id' => $oss_id,
            'id_izin' => $maxId,
            'jenis_izin' => $jenis_izin,
            'kd_daerah' => $oss_nib->perseroan_daerah_id,
            'kd_izin' => $izin_layanan->kode_izin,
            'status_checklist' => '04',
            'id_proyek' => $parentizin['id_proyek'],
            ]);


            $insert->save();
            $log= new LogHelper();
            $log->createLog('Pemenuhan Persyaratan Pengajuan Pengembalian Izin Prinsip', $maxId);

            return redirect('/')->with('message', 'Permohonan baru berhasil ditambahkan, silahkan lakukan pemenuhan
            persyaratan');
            }
        
        // }

        
    }
}