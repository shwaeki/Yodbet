<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreWorkerRequest;
use App\Http\Requests\UpdateWorkerRequest;
use App\Models\Worker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WorkerController extends Controller
{
    public function index(Request $request)
    {
        return view('backend.worker.index');
    }


    public function create()
    {
        return view('backend.worker.create');
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
        return view('backend.worker.show', compact('worker'));
    }


    public function edit(Worker $worker)
    {
        return view('backend.worker.edit', compact('worker'));
    }


    public function update(UpdateWorkerRequest $request, Worker $worker)
    {
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

    public function ajax(Request $request)
    {
        $data = [];
        if ($request->has('q')) {
            $search = $request->q;
            $data = Worker::select("id", "name")
                ->where('name', 'LIKE', "%$search%")
                ->get();
        }
        return response()->json($data);

    }
}
