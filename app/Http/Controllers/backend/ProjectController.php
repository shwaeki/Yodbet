<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Client;
use App\Models\Project;
use Illuminate\Http\Request;

class ProjectController extends Controller
{

    public function index(Request $request)
    {
        return view('backend.project.index');
    }


    public function create(Client $client)
    {
        $data=[
            'managers'=>$client->contacts()->pluck('name', 'id'),
            'client'=>$client
        ];
        return view('backend.project.create',$data);
    }


    public function store(StoreProjectRequest $request,Client $client)
    {
        $client->projects()->create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('client.show',$client);
    }


    public function show(Project $project)
    {
        return view('backend.project.show', compact( 'project'));

    }


    public function edit(Client $client, Project $project)
    {
        $data=[
            'managers'=>$client->contacts()->pluck('name', 'id'),
            'project'=>$project,
            'client'=>$client
        ];
        return view('backend.project.edit', $data);

    }


    public function update(UpdateProjectRequest $request, Client $client, Project $project)
    {
        $project->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->route('client.show',$client)->withFragment( 'projects');
    }


    public function destroy( Project $project)
    {
        $project->delete();
        flash(trans('messages.flash.destroy'))->info();
        return redirect()->route('client.index');
    }
}
