<?php

namespace App\Http\Controllers;

use App\Models\AttendanceDetails;
use App\Http\Requests\StoreAttendanceDetailsRequest;
use App\Http\Requests\UpdateAttendanceDetailsRequest;

class AttendanceDetailsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreAttendanceDetailsRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreAttendanceDetailsRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\AttendanceDetails  $attendanceDetails
     * @return \Illuminate\Http\Response
     */
    public function show(AttendanceDetails $attendanceDetails)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\AttendanceDetails  $attendanceDetails
     * @return \Illuminate\Http\Response
     */
    public function edit(AttendanceDetails $attendanceDetails)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAttendanceDetailsRequest  $request
     * @param  \App\Models\AttendanceDetails  $attendanceDetails
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateAttendanceDetailsRequest $request, AttendanceDetails $attendanceDetails)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AttendanceDetails  $attendanceDetails
     * @return \Illuminate\Http\Response
     */
    public function destroy(AttendanceDetails $attendanceDetails)
    {
        //
    }
}
