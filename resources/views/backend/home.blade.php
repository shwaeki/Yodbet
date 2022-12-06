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

    <hr>
    <div class="row ">
        <div class="col-4">
            @can('create-attendance')
                <a href="{{ route('attendance.create') }}" class="btn btn-block btn-primary">הוסף דוח שעות</a>
            @endcan</div>
        <div class="col-4">
            @can('create-client')
                <a href="{{ route('client.create') }}" class="btn btn-block btn-info">הוסף לקוח חדש</a>
            @endcan
        </div>
        <div class="col-4">
            @can('create-worker')
                <a href="{{ route('worker.create') }}" class="btn  btn-block btn-success">הוסף עובד חדש</a>
            @endcan
        </div>
    </div>
    <hr>
    <div class="row">
        <div class="col-xl-8">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">פרויקטים אחרונים</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('project.index')}}" class="btn btn-sm btn-primary">ראה הכל</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">

                    <table class="table align-items-center table-flush">

                        <thead class="thead-light">
                        <tr>
                            <th>שם הפרוייקט</th>
                            <th>כתובת</th>
                            <th>מחיר לשעה</th>
                            <th>מנהל פרוייקט</th>
                            <th>תאריך יצירה</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_projects as $project)
                            <tr>
                                <td>{{$project->name}}</td>
                                <td>{{$project->address}}</td>
                                <td>{{$project->hour_cost}}</td>
                                <td>{{$project->manager->name ?? ''}}</td>
                                <td>{{ Carbon\Carbon::parse($project->created_at)->format('Y-m-d')}}</td>
                            </tr>

                        @endforeach
                        </tbody>


                    </table>
                </div>
            </div>
        </div>
        <div class="col-xl-4">
            <div class="card">
                <div class="card-header border-0">
                    <div class="row align-items-center">
                        <div class="col">
                            <h3 class="mb-0">עובדים אחרונים</h3>
                        </div>
                        <div class="col text-right">
                            <a href="{{route('worker.index')}}" class="btn btn-sm btn-primary">ראה הכל</a>
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table class="table align-items-center table-flush">

                        <thead class="thead-light">
                        <tr>
                            <th>שם הפרוייקט</th>
                            <th>מחיר לשעה</th>
                            <th>תאריך יצירה</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($last_workers as $project)
                            <tr>
                                <td>{{$project->name}}</td>
                                <td>₪{{$project->hour_cost}}</td>
                                <td>{{ Carbon\Carbon::parse($project->created_at)->format('Y-m-d')}}</td>
                            </tr>

                        @endforeach
                        </tbody>

                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
