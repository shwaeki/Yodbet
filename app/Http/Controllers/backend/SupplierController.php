<?php

namespace App\Http\Controllers\backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\StoreSupplierRequest;
use App\Http\Requests\UpdateSupplierRequest;
use App\Models\Supplier;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SupplierController extends Controller
{

    public function __construct()
    {
        $this->middleware('permission:view-supplier');
        $this->middleware('permission:create-supplier', ['only' => ['create', 'store']]);
        $this->middleware('permission:update-supplier', ['only' => ['edit', 'update']]);
        $this->middleware('permission:destroy-supplier', ['only' => ['destroy']]);
    }

    public function index(Request $request)
    {
        return view('backend.supplier.index');
    }


    public function create()
    {
        return view('backend.supplier.create');
    }


    public function store(StoreSupplierRequest $request)
    {
        $request->merge(['added_by' => Auth::user()->id]);
        Supplier::create($request->all());
        flash(trans('messages.flash.created'))->success();
        return redirect()->route('supplier.index');
    }


    public function show(Supplier $supplier)
    {
        return view('backend.supplier.show', compact('supplier'));
    }


    public function edit(Supplier $supplier)
    {
        return view('backend.supplier.edit', compact( 'supplier'));
    }


    public function update(UpdateSupplierRequest $request, Supplier $supplier)
    {
        $supplier->update($request->all());
        flash(trans('messages.flash.updated'))->success();
        return redirect()->route('supplier.index');
    }


    public function destroy(Supplier $supplier)
    {
        $supplier->delete();
        flash(trans('messages.flash.deleted'))->info();
        return redirect()->route('supplier.index');
    }
}
