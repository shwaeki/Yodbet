@extends('layouts.app')

@push('title')
    عرض معلومات العامل
@endpush

@push('pg_btn')
    <a href="{{route('worker.index')}}" class="btn btn-sm btn-neutral">جميع العاملين</a>
@endpush

@section('content')

@endsection
