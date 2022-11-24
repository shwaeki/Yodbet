@extends('layouts.app')

@push('title')
    ادارة حضور العاملين
@endpush


@push('pg_btn')
    @can('create-category')
        <a href="{{ route('attendance.create') }}" class="btn btn-sm btn-neutral">اضافة الحضور الشهري</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">جميع معلومات الحضور</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:attendance-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
