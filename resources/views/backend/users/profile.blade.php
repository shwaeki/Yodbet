@extends('layouts.app')

@push('title')
    تعديل المعلومات الشخصية
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('profile.update', $user)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">المعلومات الشخصية</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">שם </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name', $user->name)}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">אימייל </label>
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
                            </div>
                        </div>
                        <hr class="my-4"/>

                        <h6 class="heading-small text-muted mb-4">מידע סיסמא</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password" class="form-control-label">סיסמה </label>
                                        <input type="password" class="form-control" id="password" name="password">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="password_confirmation" class="form-control-label">אימות סיסמה</label>
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
                                    <button type="submit" class="mt-5 btn btn-primary">עדכון</button>
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
