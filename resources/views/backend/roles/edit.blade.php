@extends('layouts.app')

@push('title')
    تعديل الدور
@endpush

@push('pg_btn')
    <a href="{{route('roles.index')}}" class="btn btn-sm btn-neutral">جميع الادوار</a>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    {!! Form::open(['route' => ['roles.update', $role], 'method'=>'put']) !!}
                    <h6 class="heading-small text-muted mb-4">معلومات الدور</h6>
                    <div class="pl-lg-4">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    {{ Form::label('name', 'الاسم', ['class' => 'form-control-label']) }}
                                    {{ Form::text('name', $role->name, ['class' => 'form-control']) }}
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
                                                       class="custom-control-input" id="{{ $permission }}"
                                                       @foreach ($role->permissions as $perm)
                                                           @if ($perm->id== $key))
                                                       checked
                                                       @endif
                                                       @endforeach
                                                       @if($role->name == 'super-admin')
                                                           disabled
                                                    @endif>
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
                                    {{ Form::submit('تعديل', ['class'=> 'mt-3 btn btn-primary']) }}
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
