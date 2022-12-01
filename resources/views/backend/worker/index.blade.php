@extends('layouts.app')

@push('title')
    ניהול עובדים
@endpush


@push('pg_btn')
    @can('create-category')
        <a href="{{ route('worker.create') }}" class="btn btn-sm btn-neutral">اضافة عامل جديد</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">כל העובדים</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:worker-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
