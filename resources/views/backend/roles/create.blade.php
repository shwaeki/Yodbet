@extends('layouts.app')

@push('title')
    اضافة دور جديد
@endpush


@push('pg_btn')
    <a href="{{route('roles.index')}}" class="btn btn-sm btn-neutral">جميع الادوار</a>
@endpush
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    {!! Form::open(['route' => 'roles.store']) !!}
                    <h6 class="heading-small text-muted mb-4">معلومات الدور</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'الاسم', ['class' => 'form-control-label']) }}
                                    {{ Form::text('name', null, ['class' => 'form-control']) }}
                                </div>
                            </div>
                        </div>
                        <hr class="my-4"/>
                        <div class="pl-lg-1">
                            <div class="row">

                                @foreach ($permissions as $key => $permission)
                                    <div class="col-3">
                                        <div class="form-group p-2 d-inline-block">
                                            <div class="custom-control custom-checkbox">
                                                <input type="checkbox" name="permissions[]" value="{{ $key }}"
                                                       class="custom-control-input" id="{{ $permission }}">
                                                {{ Form::label($permission, $permission, ['class' => 'custom-control-label']) }}
                                            </div>
                                        </div>
                                    </div>
                                @endforeach

                            </div>
                        </div>
                        <div class="pl-lg-1">
                            <div class="row">
                                <div class="col-md-12">
                                    {{ Form::submit('حفظ', ['class'=> 'mt-3 btn btn-primary']) }}
                                </div>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
