@extends('layouts.app')

@push('title')
    ניהול לקוחות
@endpush


@push('pg_btn')
    @can('create-client')
        <a href="{{ route('organizer.create') }}" class="btn btn-sm btn-neutral">הוסף סדראן חדש</a>
    @endcan
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-header bg-transparent">
                    <div class="row">
                        <div class="col-lg-8">
                            <h3 class="mb-0">כל הסדראנים</h3>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <livewire:organizer-table/>
                </div>
            </div>
        </div>
    </div>
@endsection
