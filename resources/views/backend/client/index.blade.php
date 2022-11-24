@extends('layouts.app')

@push('title')
    ادارة الزبائن
@endpush


@push('pg_btn')
    @can('create-category')
        <a href="{{ route('client.create') }}" class="btn btn-sm btn-neutral">اضافة زبون جديد</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">جميع الزبائن</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:client-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
