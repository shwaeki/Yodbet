@extends('layouts.app')


@push('title')
    דוח ריכוז
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">חזרה </a>
@endpush

@push('styles')
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css" rel="stylesheet"/>
    <style>
        .dataTable .sorting {
            text-align: right;
        }
    </style>
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">

                    <h6 class="heading-small text-muted mb-4">דוח ריכוז</h6>
                    <div class="pl-lg-4">
                        <div class="row">


                            <div class="col-4">
                                <form id="monthFom">
                                    <div class="form-group">
                                        <label for="date" class="form-control-label"> תאריך </label>
                                        <input type="month" class="form-control" id="month" name="month"
                                               value="{{request('month',session('mainDate')) }}" required>
                                    </div>
                                </form>
                            </div>
                        </div>

                        @if( request('month',session('mainDate')) )
                            <div class="table-responsive">
                                <div>
                                    <table class="table align-items-center table-sm table-striped"
                                           id="AttendanceTable">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>עובד</th>
                                            <th>ימי עבודה</th>
                                            <th>סך הכל שעות</th>
                                            <th>שעות רגילות</th>
                                            <th>שעות 125%</th>
                                            <th>שעות 150%</th>
                                            <th>שעות בונוס</th>
                                            <th>מידע</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach( $data as $d)
                                            <tr>
                                                <td>{{$d->id}}</td>
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->attendances['count']}}</td>
                                                <td>{{$d->attendances['sum']}}</td>
                                                <td>{{$d->attendances['hours']['hours_normal']}}</td>
                                                <td>{{$d->attendances['hours']['hours_125']}}</td>
                                                <td>{{$d->attendances['hours']['hours_150']}}</td>
                                                <td>{{$d->attendances['hours']['hours_bonus']}}</td>
                                                <td>
                                                    <button class="btn btn-sm btn-primary"
                                                            onclick="openMonthAttModel({{$d->id}})">
                                                        <i class="fas fa-info"></i>
                                                    </button>
                                                </td>
                                            </tr>

                                        @endforeach


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="monthAttModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">מידע על עבודה</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table align-items-center table-sm" id="tableMonthlyReport">
                        <thead class="thead-light">
                        <tr>
                            <th>שם העובד</th>
                            <th>תאריך</th>
                            <th>הפרויקט</th>
                            <th>מספר השעות</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">סגור</button>
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

        $('#AttendanceTable').DataTable({
            dom: 'Bfrtip',
            paginate: false,
            buttons: [
                {
                    extend: 'excelHtml5',
                    title: 'דוח ריכוז_{{request('month',session('mainDate')) }}'
                }, 'print',
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Hebrew.json",
                search: "",
            }
        });




        $('#month').on('change', function () {
            $('#monthFom').submit();
        });

        function openMonthAttModel(worker) {
            $.ajax({
                type: 'POST',
                url: '{{route('project.ajax.there')}}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    month: "{{request('month',session('mainDate')) }}",
                    worker: worker,
                },
                success: function (data) {
                    var reportTable = $('#tableMonthlyReport').DataTable({
                        dom: 'B',
                        paginate: false,
                        buttons: [
                            {
                                extend: 'excelHtml5',
                                title: 'דוח שעות של '+data.worker,
                            }
                            ,{
                                extend: 'print',
                                title: 'דוח שעות של '+data.worker,
                            },
                        ],
                    });

                    reportTable.clear().draw();
                    for (var i = 0; i < data.data.length; i++) {
                        reportTable.row.add([data.worker, data.data[i].date, data.data[i].project, data.data[i].hour_work_count]).draw(false);
                    }
                    $('#monthAttModel').modal('show');

                }
            });
        }
    </script>

@endpush
