@extends('layouts.app')

@push('title')
    הוסף לקוח חדש
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">כל הלקוחות</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('client.store')}}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">מידע ללקוחות</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">שם החשבון </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">דואר אלקטרוני </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email')}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">טלפון נייד</label>
                                        <input type="text" class="form-control only-number" id="phone" name="phone"
                                               value="{{old('phone')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="phone2" class="form-control-label">טלפון</label>
                                        <input type="text" class="form-control only-number" id="phone2" name="phone2"
                                               value="{{old('phone2')}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="taxID" class="form-control-label">ח.פ</label>
                                        <input type="text" class="form-control only-number" id="taxID" name="taxID"
                                               value="{{old('taxID')}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="city" class="form-control-label">עיר </label>
                                        <input type="text" class="form-control" id="city" name="city"
                                               value="{{old('city')}}">
                                    </div>
                                </div>

                                <div class="col-lg-3">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">כתובת </label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{old('address')}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="client_key" class="form-control-label">מפתח חשבון </label>
                                        <input type="text" class="form-control only-number" id="client_key" name="client_key"
                                               value="{{old('client_key')}}" required>
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">הוסף</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
