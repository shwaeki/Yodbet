@extends('layouts.app')

@push('title')
    שינוימידע מידע לסדראן
@endpush

@push('pg_btn')
    <a href="{{route('organizer.index')}}" class="btn btn-sm btn-neutral">כל הסדרנאים</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('organizer.update', $organizer)}}" method="POST">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">מידע לסדרנאים</h6>
                        <div class="pl-lg-6">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">שם הסדראן </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name',$organizer->name)}}" required>
                                    </div>
                                </div>


                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">טלפון נייד</label>
                                        <input type="text" class="form-control only-number" id="phone" name="phone"
                                               value="{{old('phone',$organizer->phone)}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="hour_cost" class="form-control-label">מחיר עאעה</label>
                                        <input type="text" class="form-control only-number" id="hour_cost" name="hour_cost"
                                               value="{{old('hour_cost',$organizer->hour_cost)}}" >
                                    </div>
                                </div>


                            </div>
                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">לשנות</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

