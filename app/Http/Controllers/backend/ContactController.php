<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;

use App\Models\Client;
use App\Models\Contact;

use Illuminate\Http\Request;

class ContactController extends Controller{


    public function store(Request $request,Client $client)
    {
        $client->contacts()->create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->back();
    }


    public function update(Request $request, Client $client, Contact $contact)
    {
        $contact->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->back();
    }


    public function destroy(Client $client,Contact $contact)
    {
        $contact->delete();
        flash(trans('messages.flash.destroy'))->info();
        return redirect()->route('client.index');
    }
}
