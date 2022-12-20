<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Models\Project;
use App\Models\Crane;
use Illuminate\Http\Request;

class CraneController extends Controller
{

    public function store(Request $request,Project $project)
    {
        $project->cranes()->create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('project.show',$project)->withFragment( 'cranes');
    }


    public function update(Request $request, Project $project, Crane $crane)
    {
        $crane->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->back();
    }


    public function destroy(Project $project,Crane $crane)
    {
        $crane->delete();
        flash(trans('messages.flash.deleted'))->info();
        return redirect()->route('project.show',$project)->withFragment( 'cranes');
    }
}
