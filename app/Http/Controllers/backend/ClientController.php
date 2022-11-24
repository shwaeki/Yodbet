<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreClientRequest;
use App\Http\Requests\UpdateClientRequest;
use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ClientController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view-client');
        $this->middleware('permission:create-client', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-client', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-client', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.client.index');
    }


    public function create()
    {
        return view('backend.client.create');
    }


    public function store(StoreClientRequest $request)
    {
        $request->merge(['added_by' => Auth::user()->id]);
        Client::create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('client.index');
    }


    public function show(Client $client)
    {
        $client->with('contacts');
        return view('backend.client.show', compact('client'));
    }


    public function edit(Client $client)
    {
        return view('backend.client.edit', compact( 'client'));
    }


    public function update(UpdateClientRequest $request, Client $client)
    {
        $client->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->route('client.index');
    }


    public function destroy(Client $client)
    {
        $client->delete();
        flash(trans('messages.flash.deleted'))->info();
        return redirect()->route('client.index');
    }
}
