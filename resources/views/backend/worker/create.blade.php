@extends('layouts.app')

@push('title')
    اضافة عامل جديد
@endpush

@push('pg_btn')
    <a href="{{route('worker.index')}}" class="btn btn-sm btn-neutral">جميع العاملين</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('worker.store')}}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">معلومات العامل</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">الاسم </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">البريد الاكتروني </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email')}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone1" class="form-control-label"> رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone1" name="phone1"
                                               value="{{old('phone1')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone2" class="form-control-label"> رقم الهاتف احتياطي</label>
                                        <input type="text" class="form-control" id="phone2" name="phone2"
                                               value="{{old('phone2')}}" >
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="identification" class="form-control-label">رقم الهوية</label>
                                        <input type="text" class="form-control" id="identification" name="identification"
                                               value="{{old('identification')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hour_cost" class="form-control-label"> سعر الساعة </label>
                                        <input type="text" class="form-control" id="hour_cost" name="hour_cost"
                                               value="{{old('hour_cost')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="organizer_id" class="form-control-label"> المسؤول </label>
                                        {{ Form::select('organizer_id', $organizers, null, [ 'class'=> 'selectpicker form-control', 'placeholder' => 'اختر المسؤول ...']) }}
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
                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">اضافة</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
