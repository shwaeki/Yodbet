<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreAdvanceRequest;
use App\Http\Requests\UpdateAdvanceRequest;
use App\Models\Advance;
use App\Models\AdvanceDetails;
use App\Models\Worker;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class AdvanceController extends Controller
{

    public function index()
    {
        //
    }


    public function create()
    {
        //
    }


    public function store(StoreAdvanceRequest $request)
    {


        DB::transaction(function () {

            $start_date = request("start_date");
            $payments = request("payments");
            $total = request("total");
            $worker_id = request("worker_id");
            $worker = Worker::findOrFail($worker_id);

            $advance_id = Advance::create([
                'worker_id' => $worker_id,
                'start_date' => $start_date,
                'payments' => $payments,
                'total' => $total,
                'added_by' => Auth::id()
            ]);

            $each_payment = $total/$payments;
            for ($i = 0; $i < $payments; $i++) {
                AdvanceDetails::create([
                    'advance_id' => $advance_id->id,
                    'worker_id' => $worker_id,
                    'payment_date' =>  Carbon::parse($start_date)->addMonth($i),
                    'amount' => $each_payment,
                    'paid' => false,
                ]);

            }
        }, 3);


        flash(trans('messages.flash.created'))->success();
        return redirect()->back()->withFragment('advance');;

    }


    public function show(Advance $advance)
    {
        //
    }


    public function edit(Advance $advance)
    {
        dd($advance);
    }


    public function update(UpdateAdvanceRequest $request, Advance $advance)
    {
        //
    }


    public function destroy(Advance $advance)
    {
        //
    }


    public function updateDetails(Request $request, $id)
    {
        $advanceDetails =  AdvanceDetails::findOrFail($id);
        $advanceDetails->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->back()->withFragment('advance');;
    }
}
