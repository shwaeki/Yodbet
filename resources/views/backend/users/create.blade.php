@extends('layouts.app')
@push('pg_btn')
    <a href="{{route('users.index')}}" class="btn btn-sm btn-neutral">All Users</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('users.store')}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">المعلومات الشخصية</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">الاسم </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">البريد الاكتروني </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email')}}">
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="phone_number" class="form-control-label"> رقم الهاتف </label>
                                        <input type="text" class="form-control" id="phone_number" name="phone_number"
                                               value="{{old('phone_number')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="thumbnail" class="form-control-label d-block"> الصورة </label>
                                        <div class="input-group">
                                            <span class="input-group-btn">
                                              <a id="uploadFile" data-input="thumbnail" data-preview="holder"
                                                 class="btn btn-secondary">
                                                <i class="fa fa-picture-o"></i>  اختر الصورة
                                              </a>
                                            </span>
                                            <input id="thumbnail" class="form-control d-none" type="text"
                                                   name="profile_photo">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="role" class="form-control-label"> الدور </label>
                                        {{ Form::select('role', $roles, null, [ 'class'=> 'selectpicker form-control', 'placeholder' => 'اختر الدور ...']) }}
                                    </div>
                                </div>
                            </div>
                        </div>
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
                        </div>
                        <hr class="my-4"/>
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

@push('scripts')
    <script src="{{ asset('vendor/laravel-filemanager/js/stand-alone-button.js') }}"></script>
    <script>
        jQuery(document).ready(function () {
            jQuery('#uploadFile').filemanager('file');
        })
    </script>
@endpush
