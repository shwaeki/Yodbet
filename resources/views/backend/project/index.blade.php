@extends('layouts.app')

@push('title')
    ادارة المشاريع
@endpush


@push('pg_btn')
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">جميع المشاريع</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:project-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
