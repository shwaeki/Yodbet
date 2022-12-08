<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;


use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AttendanceDetailsController extends Controller
{
    public function getWorkerForMonthAndProject(Request $request)
    {
        $data = [];

        $project = request('project');
        $month = request('month');

        $data = Worker::rightJoin("attendance_details", "workers.id", "=", "attendance_details.worker_id")
            ->rightJoin("attendances", "attendances.id", "=", "attendance_details.attendance_id")
            ->where("attendances.project_id", "=", $project)
            ->where("attendances.date", "=", $month)
            ->select("workers.*", DB::raw("SUM(attendance_details.hour_work_count) as total"))
            ->groupBy("attendance_details.worker_id")
            ->orderByDesc('total')
            ->get();


        return response()->json($data);
    }

    public function getProjectForMonthAndWorker(Request $request)
    {
        $data = [];

        $worker = request('worker');
        $month = request('month');

        $data = Project::rightJoin("attendances", "projects.id", "=", "attendances.project_id")
            ->rightJoin("attendance_details", "attendances.id", "=", "attendance_details.attendance_id")
            ->where("attendance_details.worker_id", "=", $worker)
            ->where("attendances.date", "=", $month)
            ->select("projects.*", DB::raw("SUM(attendance_details.hour_work_count) as total"))
            ->groupBy("attendances.project_id")
            ->orderByDesc('total')
            ->get();

        return response()->json($data);
    }


    public function getWorkerMonthlyReportWithProject(Request $request)
    {

        $worker = Worker::findOrFail(request('worker'));
        $date = explode('-', request('month'));
        $year = $date[0];
        $month = $date[1];

        $attendances = $worker->Attendances()->whereYear('date', '=', $year)->whereMonth('date', '=', $month)->select('hour_work_count', 'date','attendance_id')->get();

        $data = $attendances->map(function ($item) use ($month, $year) {
            $item['project'] = $item->attendance->project->name;
            return $item;
        });

        return response()->json(['worker'=>$worker->name,'data'=>$data]);
    }


}
