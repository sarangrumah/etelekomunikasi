<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Excel;

class LandingController extends Controller
{
    public function index()
    {

        $list_faq = DB::table('tb_mst_faq')->where('is_active','=','1')->get();
        // dd($header);
        return view('layouts.landing.landing', compact(['list_faq']));
        // return view('layouts.landing.migrate_notice');
    }
    public function landing_izin($izin, Request $request)
    {

        $header = DB::table('tb_mst_izin')->where('name','=',$izin)->first();
        $izinlayanan = DB::table('tb_mst_izinlayanan')->where('is_active','=','1')->where('id_mst_izin','=',$header->id)->get();
        $izinlayanan_persyaratan = DB::table('vw_izinlayanan_persyaratan')->where('id_mst_izin','=',$header->id)->get();
        $list_faq = DB::table('tb_mst_faq')->where('is_active','=','1')->get();
        // dd($header);
        return view('layouts.landing.landing_izin', compact(['header','izinlayanan','izinlayanan_persyaratan','list_faq']));
    }

    public function faq()
    {

        $list_faq = DB::table('tb_mst_faq')->where('is_active','=','1')->get();
        // dd($header);
        return view('layouts.landing.faq_menu', compact(['list_faq']));
    }
}