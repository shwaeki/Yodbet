@extends('layouts.app')

@push('title')
    שינוי מידע לעובד
@endpush

@push('pg_btn')
    <a href="{{route('worker.index')}}" class="btn btn-sm btn-neutral">כל העובדים</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('worker.update', $worker)}}" method="POST">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">מידע לעובד</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label"> שם</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name',$worker->name)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">אימייל</label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email',$worker->email)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone1" class="form-control-label"> מספר טלפו</label>
                                        <input type="text" class="form-control" id="phone1" name="phone1"
                                               value="{{old('phone1',$worker->phone1)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone2" class="form-control-label">מספר טלפון לגיבוי</label>
                                        <input type="text" class="form-control" id="phone2" name="phone2"
                                               value="{{old('phone2',$worker->phone2)}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="identification" class="form-control-label">מספר תעודת זהות</label>
                                        <input type="text" class="form-control" id="identification"
                                               name="identification"
                                               value="{{old('identification',$worker->identification)}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hour_cost" class="form-control-label"> מחיר לשעה </label>
                                        <input type="text" class="form-control" id="hour_cost" name="hour_cost"
                                               value="{{old('hour_cost',$worker->hour_cost)}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="start_work_date" class="form-control-label"> תאריך תחילת העבודה </label>
                                        <input type="date" class="form-control" id="start_work_date" name="start_work_date"
                                               value="{{old('start_work_date',$worker->start_work_date)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="end_work_date" class="form-control-label"> תאריך סיום  העבודה </label>
                                        <input type="date" class="form-control" id="end_work_date" name="end_work_date"
                                               value="{{old('end_work_date',$worker->end_work_date)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="license_expiration_date" class="form-control-label"> תאריך תפוגה של הרישיון </label>
                                        <input type="date" class="form-control" id="license_expiration_date" name="license_expiration_date"
                                               value="{{old('license_expiration_date',$worker->license_expiration_date)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="course_date" class="form-control-label"> תאריך הקורס </label>
                                        <input type="date" class="form-control" id="course_date" name="course_date"
                                               value="{{old('course_date',$worker->course_date)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="course_end_date" class="form-control-label">תאריך סיום הקורס</label>
                                        <input type="date" class="form-control" id="course_end_date"
                                               name="course_end_date"
                                               value="{{old('course_end_date',$worker->course_end_date)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="number" class="form-control-label">  מספר עובד </label>
                                        <input type="text" class="form-control" id="number" name="number"
                                               value="{{old('number',$worker->number)}}">
                                    </div>
                                </div>


                                <div class="col-lg-12">
                                    <div class="form-group d-flex">
                                        <label class="custom-toggle">
                                            <input type="checkbox" value="1" id="status" name="status" @if($worker->status){{'checked'}} @endif>
                                            <span class="custom-toggle-slider rounded-circle" data-label-off="לא "
                                                  data-label-on="כן"></span>
                                        </label>
                                        <label for="status" class="ml-3">מצב עובד</label>
                                    </div>
                                </div>

                            </div>


                                <div class="row">
                                    <div class="col-md-12">
                                        <button type="submit" class="mt-5 btn btn-primary">לשׁנות</button>
                                    </div>
                                </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
