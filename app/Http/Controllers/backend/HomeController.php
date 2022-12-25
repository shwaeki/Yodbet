<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\AttendanceDetails;
use App\Models\Client;
use App\Models\Project;
use App\Models\Worker;

class HomeController extends Controller
{

    public function __construct()
    {
    }


    public function home()
    {
        if (request('date')) {
            session(['mainDate' => request('date')]);
            return redirect()->back();
        }


        $data = [
            'total_client' => Client::count(),
            'total_Worker' => Worker::count(),
            'total_project' => Project::count(),
            'total_hours' => AttendanceDetails::sum('hour_work_count'),
        ];

        $date = explode('-', request('month', session('mainDate')));
        if (isset($date[0]) && isset($date[1])) {
            $year = $date[0];
            $month = $date[1];

            $data = [
                'total_client' => Client::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->count(),
                'total_Worker' => Worker::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->count(),
                'total_project' => Project::whereYear('created_at', '=', $year)->whereMonth('created_at', '=', $month)->count(),
                'total_hours' => AttendanceDetails::whereYear('date', '=', $year)->whereMonth('date', '=', $month)->sum('hour_work_count'),
            ];

        }


        return view('backend.home', $data);
    }

    public function media()
    {
        return view('backend.media.index');
    }

    public function components()
    {
        return view('backend.components');
    }
}
