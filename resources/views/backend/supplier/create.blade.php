@extends('layouts.app')

@push('title')
    اضافة تصنيف جديد
@endpush

@push('pg_btn')
    <a href="{{route('supplier.index')}}" class="btn btn-sm btn-neutral">جميع الموردين</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('supplier.store')}}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">معلومات المورد</h6>
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_name" class="form-control-label">اسم المورد</label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{old('name')}}" required>
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="category_name" class="form-control-label">البريد الاكتروني </label>
                                        <input type="email" class="form-control" id="email" name="email"
                                               value="{{old('email')}}">
                                    </div>
                                </div>

                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label"> رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{old('phone')}}">
                                    </div>
                                </div>
                                <div class="col-lg-6">
                                    <div class="form-group">
                                        <label for="address" class="form-control-label">عنوان المورد</label>
                                        <input type="text" class="form-control" id="address" name="address"
                                               value="{{old('address')}}">
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
