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
            return  redirect()->back();
        }


        $data = [
            'total_client' => Client::count(),
            'total_Worker' => Worker::count(),
            'total_project' => Project::count(),
            'total_hours' => AttendanceDetails::sum('hour_work_count'),
            'last_projects' => Project::latest()->take(10)->get(),
            'last_workers' => Worker::latest()->take(10)->get(),
        ];

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
