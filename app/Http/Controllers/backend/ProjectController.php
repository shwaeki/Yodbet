<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Attendance;
use App\Models\Client;
use App\Models\Project;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        return view('backend.project.index');
    }


    public function create(Client $client)
    {
        $data = [
            'managers' => $client->contacts()->pluck('name', 'id'),
            'client' => $client
        ];
        return view('backend.project.create', $data);
    }


    public function store(StoreProjectRequest $request, Client $client)
    {
        $client->projects()->create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('client.show', $client)->withFragment('projects');
    }


    public function show(Project $project)
    {
        $workersAtt = Worker::rightJoin("attendance_details", "workers.id", "=", "attendance_details.worker_id")
            ->rightJoin("attendances", "attendances.id", "=", "attendance_details.attendance_id")
            ->where("attendances.project_id", "=", $project->id)
            ->select("workers.*", DB::raw("SUM(attendance_details.hour_work_count) as total"))
            ->groupBy("attendance_details.worker_id")
            ->orderByDesc('total')
            ->get();


        $monthAtt = Attendance::rightJoin("attendance_details", "attendances.id", "=", "attendance_details.attendance_id")
            ->where("attendances.project_id", "=", $project->id)
            ->select("attendances.*", DB::raw("SUM(attendance_details.hour_work_count) as total"))
            ->groupBy("attendances.date")
            ->orderByDesc('total')
            ->get();


        $data = [
            'project' => $project,
            'workersAtt' => $workersAtt,
            'monthAtt' => $monthAtt,
        ];


        Session::put('fileManagerConfig', "Project_" . $project->id);
        return view('backend.project.show', $data);
    }


    public function edit(Client $client, Project $project)
    {
        $data = [
            'managers' => $client->contacts()->pluck('name', 'id'),
            'project' => $project,
            'client' => $client
        ];
        return view('backend.project.edit', $data);

    }


    public function update(UpdateProjectRequest $request, Client $client, Project $project)
    {
        $project->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->route('client.show', $client)->withFragment('projects');
    }


    public function destroy(Project $project)
    {
        $project->delete();
        flash(trans('messages.flash.destroy'))->info();
        return redirect()->route('client.index');
    }
}
