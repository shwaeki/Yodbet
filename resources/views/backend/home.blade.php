@extends('layouts.app')

@section('content')

    <div class="row">
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">מספר עובדים</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_Worker}} עובד</span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-red text-white rounded-circle shadow">
                                <i class="ni ni-active-40"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">מספר לקוחות</h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_client}} לקוח </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-orange text-white rounded-circle shadow">
                                <i class="ni ni-chart-pie-35"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">מספר פרויקטים </h5>
                            <span class="h2 font-weight-bold mb-0">{{$total_project}} פרויקט  </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-green text-white rounded-circle shadow">
                                <i class="ni ni-money-coins"></i>
                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
        <div class="col-xl-3 col-md-6">
            <div class="card card-stats">
                <!-- Card body -->
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <h5 class="card-title text-uppercase text-muted mb-0">שעות עבודה</h5>
                            <span class="h2 font-weight-bold mb-0"> {{$total_hours}} שעות עבודה </span>
                        </div>
                        <div class="col-auto">
                            <div class="icon icon-shape bg-gradient-info text-white rounded-circle shadow">
                                <i class="ni ni-chart-bar-32"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <hr class="m-3 mt--1">
    <div class="card">
        <div class="card-body">
            <div class="row ">
                <div class="col-12 col-md-3 mb-3">
                    <form id="monthForm">
                        <div class="input-group">
                            <input type="month" class="form-control" id="date" name="date"
                                   value="{{ request('date',session('mainDate')) }}"
                                   required>
                            {{--                    <div class="input-group-append">
                                                    <button class="btn btn-warning" type="submit">בחר</button>
                                                </div>--}}
                        </div>
                    </form>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('attendance.create') }}" class="btn h-100 btn-block btn-primary">הוסף דוח
                        שעות</a>
                </div>

                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('attendance.report') }}" class="btn h-100 btn-block btn-primary">דוח ריכוז</a>
                </div>

                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('users.index') }}" class="btn h-100 btn-block btn-primary">משתמשים </a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('organizer.index') }}" class="btn h-100 btn-block btn-primary">סדראנים </a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('organizer.report') }}" class="btn h-100 btn-block btn-primary">דוח סדראנים</a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('project.report') }}" class="btn h-100 btn-block btn-primary">דוח הפרויקטים</a>
                </div>

                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('project.index') }}" class="btn h-100 btn-block btn-primary">כל הפרויקטים</a>
                </div>

                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('client.create') }}" class="btn h-100 btn-block btn-primary">הוסף לקוח חדש</a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('client.index') }}" class="btn h-100 btn-block btn-primary">כל הלקוחות</a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('worker.create') }}" class="btn h-100 btn-block btn-primary">הוסף עובד חדש</a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('worker.index') }}" class="btn h-100 btn-block btn-primary">כל העובדים </a>
                </div>
                <div class="col-12 col-md-3 mb-3">
                    <a href="{{ route('worker.advance.report') }}" class="btn h-100 btn-block btn-primary">דוח מקדמות</a>
                </div>
            </div>
        </div>
    </div>



    <div class="modal fade" id="mainMonthModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form>
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">בחר חודש</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <label for="date" class="form-label">חודש</label>
                        <input type="month" class="form-control" id="date" name="date"
                               value="{{ request('date') }}" required>
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-primary">בחר</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection

@push('scripts')
    @if(session('mainDate') == null)
        <script>
            $('#mainMonthModal').modal('show')
        </script>
    @endif

    <script>
        $('#date').on('change', function () {
            $("#monthForm").submit();
        });
    </script>
@endpush
