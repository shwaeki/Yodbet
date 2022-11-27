<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Project;
use App\Models\Worker;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use DateInterval;
use DatePeriod;
use DateTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AttendanceController extends Controller
{

    public function index(Request $request)
    {
        return view('backend.attendance.index');
    }


    public function create()
    {
        $daysCount = null;
        $project = null;
        $projectAttendance = null;
        $extraAttendance = [];
        $minMonth = Carbon::now()->now()->subMonths(2)->format('Y-m');
        $maxMonth = Carbon::now()->subMonths(-5)->format('Y-m');

        $date_request = request('month');
        $project_request = request('project');
        $crane_request = request('crane');
        if ($date_request) {
            $date = explode('-', $date_request);
            $daysCount = Carbon::createFromDate($date[0], $date[1], 1)->daysInMonth;
        }
        if ($project_request && $date_request) {
            $project = Project::findOrFail($project_request);
            if ($crane_request) {
                $attendance = $project->attendances()->where('crane_id', $crane_request)
                    ->where('date', $date_request)->first();
                if ($attendance) {
                    $projectAttendance = $attendance->attendances()->where('is_extra',null)->get();
                    $extraAttendance = $attendance->attendances()->where('is_extra',true)->get();
                }
            }
        }

        $data = [
            'projects' => Project::where('status', 'pending')->get()->pluck('name', 'id'),
            'project' => $project,
            'projectAttendance' => $projectAttendance,
            'extraAttendance' => $extraAttendance,
            'minMonth' => $minMonth,
            'maxMonth' => $maxMonth,
            'daysCount' => $daysCount,
        ];
        return view('backend.attendance.create', $data);
    }

    public function store(StoreAttendanceRequest $request)
    {

        // dd($request->all());
        $date = request("date");
        $project_id = request("project_id");
        $attendance_details = request("attendance");
        $project = Project::findOrFail($project_id);
        $hour_cost_project = $project->hour_cost;

        DB::transaction(function () use ($hour_cost_project, $attendance_details, $project_id, $date) {
            $attendance_id = Attendance::updateOrCreate([
                'project_id' => $project_id,
                'date' => $date
            ], ['added_by' => Auth::user()->id])->id;

            foreach ($attendance_details as $details) {
                // dd($details);
                if (isset($details['date']) && isset($details['worker']) && isset($details['hours'])) {
                    $worker = Worker::findOrFail($project_id);
                    $checkData = [
                        'attendance_id' => $attendance_id,
                        'date' => $details['date'],
                    ];
                    if (isset($details['extra'])) {
                        $checkData['is_extra'] = $details['extra'];
                    }
                    $updateData = [
                        'worker_id' => $details['worker'],
                        'hour_work_count' => $details['hours'],
                        'hour_cost_project' => $hour_cost_project,
                        'hour_cost_worker' => $worker->hour_cost,
                    ];

                    if (isset($details['extra'])) {
                        $updateData['is_extra'] = $details['extra'];
                    }
                    AttendanceDetails::updateOrCreate($checkData, $updateData);
                }
            }
        }, 3);


        flash(trans('messages.flash.created'))->success();
        return redirect()->route('attendance.index');
    }


    public function show(Attendance $attendance)
    {
        return view('backend.attendance.show', compact('attendance'));
    }


    public function edit(Attendance $attendance)
    {
        return view('backend.attendance.edit', compact('attendance'));
    }


    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        $attendance->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->route('attendance.index');
    }


    public function destroy(Attendance $attendance)
    {
        $attendance->delete();
        flash(trans('messages.flash.deleted'))->info();
        return redirect()->route('attendance.index');
    }
}
