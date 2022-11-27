@extends('layouts.app')

@push('title')
    تعديل العامل
@endpush

@push('pg_btn')
    <a href="{{route('worker.index')}}" class="btn btn-sm btn-neutral">جميع العاملين</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('worker.update', $worker)}}" method="POST">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">معلومات العامل</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label"> الاسم</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name',$worker->name)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">البريد الاكتروني </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email',$worker->email)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone1" class="form-control-label"> رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone1" name="phone1"
                                               value="{{old('phone1',$worker->phone1)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone2" class="form-control-label"> رقم الهاتف احتياطي</label>
                                        <input type="text" class="form-control" id="phone2" name="phone2"
                                               value="{{old('phone2',$worker->phone2)}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="identification" class="form-control-label">رقم الهوية</label>
                                        <input type="text" class="form-control" id="identification"
                                               name="identification"
                                               value="{{old('identification',$worker->identification)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hour_cost" class="form-control-label"> سعر الساعة </label>
                                        <input type="text" class="form-control" id="hour_cost" name="hour_cost"
                                               value="{{old('hour_cost',$worker->hour_cost)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="organizer_id" class="form-control-label"> المسؤول </label>
                                        {{ Form::select('organizer_id', $organizers, old('hour_cost',$worker->organizer_id), [ 'class'=> 'selectpicker form-control', 'placeholder' => 'اختر المسؤول ...']) }}
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="is_organizer" class="form-control-label"> نوع العامل </label>
                                        <select class="form-control" id="is_organizer" name="is_organizer" required>
                                            <option value="0">عامل</option>
                                            <option value="1">منظم</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group d-flex">
                                        <label class="custom-toggle">
                                            <input type="checkbox" value="1" id="status" name="status" @if($worker->status){{'checked'}} @endif>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="لا "
                                                  data-label-on="نعم"></span>
                                        </label>
                                        <label for="status" class="ml-3">حالة الموظف</label>
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
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
