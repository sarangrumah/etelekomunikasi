<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Admin\User;
use App\Models\Admin\JobPosition;
use App\Models\Admin\Izin;
use App\Models\Admin\Nib;
use App\Models\Admin\Disposisi;
use App\Models\Admin\Izinoss;
use App\Models\Admin\Izinlog;
use App\Models\Admin\Catatankoordinator;
use App\Models\Admin\Penanggungjawab;
use App\Models\Admin\Ulo;
use App\Models\Admin\Ulolog;
use App\Models\Admin\Disposisiulo;
use App\Models\Admin\Penomoran;
use App\Helpers\IzinHelper;
use App\Helpers\CommonHelper;
use App\Helpers\EmailHelper;
use App\Helpers\LogHelper;
use App\Helpers\DateHelper;
use Illuminate\Validation\ValidationException;
use Session;
use Redirect;
use Auth;
use Config;
use DB;
use Str;

class RekapController extends Controller
{
    public function index(Request $request){
        // --- PROFILING START ---
        \DB::flushQueryLog();
        \DB::enableQueryLog();
        $startMemory = memory_get_usage();
        // --- PROFILING START ---

        $date_reformat = new DateHelper();
        $limit_db = Config::get('app.admin.limit');
        $id_departemen_user = Session::get('id_departemen');

        $izin = Izin::query();
        // Filtering
        if ($request->filled('search')) {
            $izin->where('nama_perseroan', 'like', '%' . $request->search . '%');
        }
        if ($request->filled('status')) {
            $izin->where('status_checklist', $request->status);
        }
        if ($request->filled('date_from') && $request->filled('date_to')) {
            $izin->whereBetween('created_at', [$request->date_from, $request->date_to]);
        }
        $izin->whereIn('status_checklist', [90, 50]);
        if ($id_departemen_user == 6) {
            $izin->distinct('id_izin');
        } else {
            $izin->where('id_master_izin', $id_departemen_user)->distinct('id_izin');
        }
        $izin = $izin->paginate($limit_db);

        $countdisposisi = IzinHelper::countIzin(20, $id_departemen_user);
        $countpersetujuan = IzinHelper::countIzin(903, $id_departemen_user);

        $paginate = $izin;
        $izin = $izin->toArray();

        $jenis_izin = 'Izin Penyelenggaraan Jasa Telekomunikasi';
        $date_reformat = new DateHelper();

        $result = view('layouts.backend.rekap.rekap_sklo', [
            'date_reformat' => $date_reformat,
            'izin' => $izin,
            'paginate' => $paginate,
            'countdisposisi' => $countdisposisi,
            'countpersetujuan' => $countpersetujuan,
            'jenis_izin' => $jenis_izin
        ]);

        // --- PROFILING END ---
        $endMemory = memory_get_usage();
        $queryCount = count(\DB::getQueryLog());
        \Log::info('PROFILE: RekapController@index', [
            'queries' => $queryCount,
            'memory_kb' => ($endMemory - $startMemory) / 1024
        ]);
        // --- PROFILING END ---

        return $result;
    }
    
}