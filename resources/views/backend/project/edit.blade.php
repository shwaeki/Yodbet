@extends('layouts.app')

@push('title')
    تعديل المشروع
@endpush

@push('pg_btn')
    <a href="{{route('project.index')}}" class="btn btn-sm btn-neutral">جميع المشاريع</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('client.project.update',[$client,$project])}}" method="POST">
                        @csrf
                        @method("PUT")
                        <h6 class="heading-small text-muted mb-4">معلومات المشروع</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">اسم المشروع </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name',$project->name)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">عنوان المشروع </label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{old('address',$project->address)}}" placeholder="القدس - شعفاط" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="start_date" class="form-control-label"> تاريخ بدء المشروع </label>
                                        <input type="date" class="form-control" id="start_date" name="start_date"
                                               value="{{old('start_date',$project->start_date)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="end_date" class="form-control-label"> تاريخ انتهاء المشروع</label>
                                        <input type="date" class="form-control" id="end_date" name="end_date"
                                               value="{{old('end_date',$project->end_date)}}" required >
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hour_cost" class="form-control-label"> سعر الساعة </label>
                                        <input type="text" class="form-control" id="hour_cost" name="hour_cost"
                                               value="{{old('hour_cost',$project->hour_cost)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="manager_id" class="form-control-label"> مدير المشروع  </label>
                                        {{ Form::select('manager_id', $managers,old('manager_id',$project->manager_id), [ 'class'=> 'selectpicker form-control', 'placeholder' => 'اختر مدير المشروع ...']) }}
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">تعديل</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
