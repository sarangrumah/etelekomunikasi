<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use DB;
use Session;
use Config;

class ScheduleController extends Controller
{
    function __construct()
    {
        $this->middleware('admin');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function show()
    {
        // $events = DB::table('tb_mst_uloschedule')->get();
        // $eventsjs = json( $events);
        return response()->view('layouts.backend.evaluator.ulo-schedule');
    }

    public function getschedule(Request $request)
    {
        // Fetch events from the database
        // $events = DB::table('vw_uloschedule')->get(); // Adjust this as needed (you might want to format data)
        
        // return response()->json($events);

        $month = $request->query('month');
        $year = $request->query('year');

        // Fetch events from the database
        // Adjust the query to filter results based on month and year
        $events = DB::table('vw_uloschedule')
            ->whereMonth('start', $month) // Replace 'date_column' with your actual date column name
            ->whereYear('start', $year)   // Again, replace 'date_column' as needed
            ->get();

        return response()->json($events);
    }
}
