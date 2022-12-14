<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreOrganizerRequest;
use App\Http\Requests\UpdateOrganizerRequest;
use App\Models\Organizer;
use App\Models\Project;
use Illuminate\Http\Request;

class OrganizerController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.organizer.index');
    }

    public function create()
    {
        return view('backend.organizer.create');
    }


    public function store(StoreOrganizerRequest $request)
    {
        Organizer::create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('organizer.index');
    }

    public function show(Organizer $organizer)
    {
        //
    }

    public function edit(Organizer $organizer)
    {
        $data = [
            'organizer' => $organizer,
        ];
        return view('backend.organizer.edit', $data);
    }


    public function update(UpdateOrganizerRequest $request, Organizer $organizer)
    {

        $organizer->update($request->all());
        flash(trans('messages.flash.updated'))->success();;
        return redirect()->route('organizer.index');
    }


    public function destroy(Organizer $organizer)
    {
        $organizer->delete();
        flash(trans('messages.flash.destroy'))->info();
        return redirect()->route('organizer.index');
    }


    public function report()
    {

        $data = [
            'organizers' => Organizer::all()->pluck('name', 'id'),
        ];
        if (request('organizer')) {
            $data['organizer'] = Organizer::findOrFail(request('organizer'));
        }


        if (request('month', session('mainDate'))) {
            $data['month'] = request('month', session('mainDate'));
        }
        return view('backend.organizer.report', $data);
    }
}
