@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('users.index')}}" class="btn btn-sm btn-neutral">All Users</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('users.update',$user)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">المعلومات الشخصية</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">الاسم </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name', $user->name)}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">البريد الاكتروني </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email', $user->email)}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label">מספר טלפון </label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                               value="{{old('phone_number', $user->phone_number)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="role" class="form-control-label"> الدور </label>
                                        {{ Form::select('role', $roles,  $user->roles, [ 'class'=> 'selectpicker form-control', 'placeholder' => 'اختر الدور ...']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        {{--
                        <hr class="my-4"/>

                       <h6 class="heading-small text-muted mb-4">معلومات كلمة المرور</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">كلمة المرور </label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-control-label">تاكيد كلمة
                                            المرور </label>
                                        <input type="password" class="form-control" id="password_confirmation"
                                               name="password_confirmation">
                                    </div>
                                </div>
                            </div>
                        </div>--}}
                        <hr class="my-4"/>
                        <div class="pl-lg-4">
                            <div class="row">
                                @can('update-user')
                                    <div class="col-md-12">
                                        <button type="submit" class="mt-5 btn btn-primary">עדכון</button>
                                    </div>
                                @endcan
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
