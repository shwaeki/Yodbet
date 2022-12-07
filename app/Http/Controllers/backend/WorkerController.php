<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Attendance;
use App\Models\AttendanceDetails;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.worker.index');
    }


    public function create()
    {
        $data = [
            'organizers' => Worker::where('is_organizer', true)->where('status', true)->get()->pluck('name', 'id'),
        ];
        return view('backend.worker.create', $data);
    }


    public function store(StoreWorkerRequest $request)
    {
        $request->merge(['added_by' => Auth::user()->id]);
        Worker::create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('worker.index');
    }


    public function show(Worker $worker)
    {

        $projectAtt = Project::rightJoin("attendances", "projects.id", "=", "attendances.project_id")
            ->rightJoin("attendance_details", "attendances.id", "=", "attendance_details.attendance_id")
            ->where("attendance_details.worker_id", "=", $worker->id)
            ->select("projects.*", DB::raw("SUM(attendance_details.hour_work_count) as total"))
            ->groupBy("attendances.project_id")
            ->orderByDesc('total')
            ->get();


        $monthAtt = Attendance::rightJoin("attendance_details", "attendances.id", "=", "attendance_details.attendance_id")
            ->where("attendance_details.worker_id", "=", $worker->id)
            ->select("attendances.*", DB::raw("SUM(attendance_details.hour_work_count) as total"))
            ->groupBy("attendances.date")
            ->orderByDesc('total')
            ->get();

        $data = [
            'worker' => $worker->load('Attendances'),
            'projectAtt' => $projectAtt,
            'monthAtt' => $monthAtt,
        ];


        Session::put('fileManagerConfig', "Worker_" . $worker->id);
        return view('backend.worker.show', $data);
    }


    public function edit(Worker $worker)
    {
        $data = [
            'worker' => $worker,
            'organizers' => Worker::where('is_organizer', true)
                ->where('id', '!=', $worker->id)->where('status', true)
                ->get()->pluck('name', 'id'),
        ];
        return view('backend.worker.edit', $data);
    }


    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
        // dd($request->all());
        $request->merge(['status' => $request->has('status')]);
        $worker->update($request->all());
        flash(trans('messages.flash.updated'))->success();;
        return redirect()->route('worker.index');
    }


    public function destroy(Worker $worker)
    {
        $worker->delete();
        flash(trans('messages.flash.destroy'))->info();
        return redirect()->route('worker.index');
    }

    public function checkWorkerStatusInDate(Request $request)
    {

        $worker = request('worker');
        $date = request('date');

        $data = AttendanceDetails::query()->where('date', $date)->where('worker_id', $worker)->count();
        if ($data > 0)
            return response()->json(['status' => false]);
        return response()->json(['status' => true]);
    }

    public function ajax(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Worker::select("id", "name", "identification")
                ->where('is_organizer', false)
                ->where('status', true)
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);
    }


    public function storeAjax(StoreWorkerRequest $request)
    {
        $request->merge(['added_by' => Auth::user()->id]);
        $data = Worker::create($request->all());
        return response()->json(['status' => true, 'data' => $data]);
    }


    public function getWorkerMonthlyReport(Request $request)
    {
        $worker = Worker::findOrFail(request('worker'));
        $date = explode('-', request('month'));
        $year = $date[0];
        $month = $date[1];

        $totalHours = $worker->Attendances()->whereYear('date', '=', $year)->whereMonth('date', '=', $month)->get()->pluck('hour_work_count', 'date');
        $data = $this->calculatorExtraHours($totalHours);
        return response()->json($data);
    }


    private function calculatorExtraHours($totalHours)
    {
        $data = [];
        $data['hours_normal'] = 0;
        $data['hours_125'] = 0;
        $data['hours_150'] = 0;
        $data['hours_bonus'] = 0;
        foreach ($totalHours as $hour) {
            $hours = $hour;
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
