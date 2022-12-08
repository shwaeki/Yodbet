<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAttendanceRequest;
use App\Http\Requests\UpdateAttendanceRequest;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Crane;
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


        $date_request = request('month',session('mainDate'));
        $project_request = request('project');
        $crane_request = request('crane');
        if ($date_request) {
            $date = explode('-', $date_request);
            $daysCount = Carbon::createFromDate($date[0], $date[1], 1)->daysInMonth;
        }
        if ($project_request && $date_request) {
            $project = Project::findOrFail($project_request);
            if ($crane_request) {
                $crane = Crane::findOrFail($crane_request);
                if ($crane) {
                    $attendance = $project->attendances()->where('crane_id', $crane_request)
                        ->where('date', $date_request)->first();
                    if ($attendance) {
                        $projectAttendance = $attendance->attendances()->where('is_extra', null)->get();
                        $extraAttendance = $attendance->attendances()->where('is_extra', true)->get();
                    }
                }
            }
        }
        $projects = Project::select(DB::raw('CONCAT(c.name," - " ,projects.name) as name , projects.id'))
            ->join('clients AS c', 'c.id', '=', 'projects.client_id')->where('status', 'pending')->get()->pluck('name', 'id');


        $data = [
            'projects' => $projects,
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
        $crane_id = request("crane_id");
        $attendance_details = request("attendance");
        $project = Project::findOrFail($project_id);
        $hour_cost_project = $project->hour_cost;

        DB::transaction(function () use ($crane_id, $hour_cost_project, $attendance_details, $project_id, $date) {
            $attendance_id = Attendance::updateOrCreate([
                'project_id' => $project_id,
                'crane_id' => $crane_id,
                'date' => $date
            ], ['added_by' => Auth::user()->id])->id;

            foreach ($attendance_details as $details) {
                // dd($details);
                if (isset($details['date'])) {
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
        return redirect()->back();
    }


    public function show(Attendance $attendance)
    {

    }


    public function edit(Attendance $attendance)
    {
//        return view('backend.attendance.edit', compact('attendance'));
    }


    public function update(UpdateAttendanceRequest $request, Attendance $attendance)
    {
        /*        $attendance->update($request->all());
                flash(trans('messages.flash.updated'))->success();
                return redirect()->route('attendance.index');*/
    }


    public function destroy(Attendance $attendance)
    {
        /*        $attendance->delete();
                flash(trans('messages.flash.deleted'))->info();
                return redirect()->route('attendance.index');*/
    }

    public function showReport(Attendance $attendance)
    {
        $data = [];
        $date = request('month',session('mainDate'));
        if ($date) {

            $date = explode('-', $date);
            $year = $date[0];
            $month = $date[1];

            $totalHours = Worker::with(['Attendances' => function ($q) use ($year, $month) {
                $q->whereYear('date', '=', $year);
                $q->whereMonth('date', '=', $month);
                $q->select('id', 'date', 'worker_id', 'hour_work_count');
            }])->select('id', 'name')->get();


            $data = $totalHours->map(function ($item) use ($month, $year) {
                $attend = $item->Attendances()->whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get();
                $item['attendances']['sum'] = $item->Attendances->sum('hour_work_count');
                $item['attendances']['hours'] = $this->calculatorExtraHours($attend);
                $item['attendances']['count'] = $attend->count();
                return $item;
            });
        }
        //   return response()->json($data);
        return view('backend.attendance.show', compact('data'));
    }


    private function calculatorExtraHours($totalHours)
    {
        $data = [];
        $data['hours_normal'] = 0;
        $data['hours_125'] = 0;
        $data['hours_150'] = 0;
        $data['hours_bonus'] = 0;
        foreach ($totalHours as $hour) {
            $hours = $hour->hour_work_count;
            if ($hours >= 8.5) {
                $data['hours_normal'] += 8.5;
                $hours -= 8.5;
                if ($hours >= 2) {
                    $data['hours_125'] += 2;
                    $hours -= 2;
                } else {
                    $data['hours_125'] += $hours;
                    $hours -= $hours;
                }
                if ($hours >= 2) {
                    $data['hours_150'] += 2;
                    $hours -= 2;
                } else {
                    $data['hours_150'] += $hours;
                    $hours -= $hours;
                }
                if ($hours > 0) {
                    $data['hours_bonus'] += $hours;
                }
            } else {
                $data['hours_normal'] += $hours;
            }
        }
        return $data;
    }

}
