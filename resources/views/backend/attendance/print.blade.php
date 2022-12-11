@extends('layouts.app')

@push('styles')
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css" rel="stylesheet"/>
    <style>
        .dataTable .sorting {
            text-align: right;
        }
    </style>
@endpush


@push('title')
    ניהול נוכחות עובדים
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">חזרה </a>
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('attendance.store')}}" method="POST" >
                        @csrf
                        <div class="pl-lg-4 ">
                            @if($project && $daysCount && request('crane') )
                                <div class="table-responsive">
                                    <div>
                                        <table class="table align-items-center table-sm table-striped" id="AttendanceTable">
                                            <thead class="thead-light">
                                            <tr>
                                                <th>#</th>
                                                <th>תאריל</th>
                                                <th style="width:30%">עובד</th>
                                                <th style="width:20%">מספר השעות</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <tr>
                                                <th></th>
                                                <th></th>
                                                <th></th>
                                                <td class="text-right" colspan="4">
                                                    <h4 class="mb-0">סך הכול שעות: <span class="totalHours">0</span></h4>
                                                </td>
                                            </tr>
                                            @for ($day = 1; $day <=$daysCount ; $day++)
                                                @php
                                                    $attendance = null;
                                                     $date = request('month',session('mainDate')).'-'.str_pad($day,2,'0',STR_PAD_LEFT);
                                                     $dayname = date('l', strtotime($date));
                                                    if ($projectAttendance){
                                                        $attendance = $projectAttendance->where('date', $date)->first();
                                                    }
                                                @endphp
                                                @if($dayname != "Saturday")
                                                    <tr @class(['table-success' => $attendance, 'table-danger' => $dayname == "Saturday",])>


                                                        <td>{{$day}}</td>
                                                        <td>
                                                            {{$date}}
                                                        </td>
                                                        <td>
                                                            {{$attendance->worker?->name ?? ''}}- {{$attendance->worker?->identification}}
                                                        </td>
                                                        <td>
                                                            {{ $attendance->hour_work_count ??'' }}     שעות
                                                        </td>

                                                    </tr>
                                                @endif
                                            @endfor

                                            @foreach ($extraAttendance as $extra)
                                                <tr class="table-info">

                                                    <td>{{($day+$loop->index)}}</td>
                                                    <td>
                                                        {{$extra->date}}
                                                    </td>
                                                    <td>
                                                        {{$extra->worker?->name}}- {{$extra->worker?->identification}}
                                                    </td>
                                                    <td>
                                                        {{ $extra->hour_work_count ??'' }}     שעות
                                                    </td>
                                                </tr>

                                            @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif


                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection



@push('scripts')
    <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/dataTables.buttons.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.print.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap4.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.3.2/js/buttons.bootstrap4.min.js"></script>

    <script>

        function getTotalHours() {
            var total = 0;
            $('.hours').each(function () {
                total += +$(this).val();
            });
            $('.totalHours').html(total);
        }
        $(document).ready(function () {

            getTotalHours();

           $('#AttendanceTable').DataTable({
                dom: 'B',
                paginate: false,
                buttons: [
                    {
                        extend: 'excelHtml5',
                    }
                    ,{
                        extend: 'print',
                    },
                ],
            });

        })
    </script>

@endpush
