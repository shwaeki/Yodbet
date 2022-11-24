@extends('layouts.app')

@push('title')
    تعديل الزبون
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">جميع الزبائن</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('client.update', $client)}}" method="POST">
                        @csrf
                        @method('put')
                        <h6 class="heading-small text-muted mb-4">معلومات الزبون</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label"> الاسم</label>
                                        <input type="text" class="form-control" id="name" value="{{$client->name}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="email" class="form-control-label">البريد الاكتروني </label>
                                        <input type="email" class="form-control" id="email" value="{{$client->email}}" required>
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label"> رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone" value="{{$client->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="taxID" class="form-control-label"> رقم الضريبة</label>
                                        <input type="text" class="form-control" id="taxID" value="{{$client->taxID}}" required>
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
