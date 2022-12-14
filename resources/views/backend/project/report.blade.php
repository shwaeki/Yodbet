@extends('layouts.app')


@push('title')
    דוח פרויקטיים
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

                    <h6 class="heading-small text-muted mb-4">דוח פרויקטיים</h6>
                    <div class="pl-lg-4">

                        <div class="table-responsive">
                            <div>
                                <table class="table align-items-center table-sm table-striped"
                                       id="AttendanceTable">
                                    <thead class="thead-light">
                                    <tr>
                                        <th>#</th>
                                        <th>פרויקט</th>
                                        <th>לקוח</th>
                                        <th>סדראן</th>
                                        <th>ח.פ</th>
                                        <th>מחיר לשעה</th>
                                        <th> מספר שעות</th>

                                        <th> סך הכל לפני מעם</th>
                                        <th>סך הכל אחרי מעם</th>


                                        <th>מידע</th>
                                    </tr>
                                    </thead>
                                    <tbody>

                                    @foreach( $projects as $project)
                                        @php($totalHours = $project->attendancesDetails()->sum('hour_work_count'))
                                        @php($total = $totalHours*$project->hour_cost)
                                        <tr>
                                            <td>{{$loop->index}}</td>
                                            <td>{{$project->name}}</td>
                                            <td>{{$project->client->name}}</td>
                                            <td>{{$project->organizer?->name}}</td>
                                            <td>{{$project->client->taxID}}</td>
                                            <td>@money($project->hour_cost)</td>
                                            <td>{{$totalHours}}</td>
                                            <td>@money($total)</td>
                                            <td>@money( $total *1.17 )</td>

                                            <td>
                                                <button class="btn btn-sm btn-primary"
                                                        onclick="openMonthAttModel({{$project->id}})">
                                                    <i class="fas fa-info"></i>
                                                </button>
                                            </td>
                                        </tr>

                                    @endforeach


                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="monthAttModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">מידע על פרויקט</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table align-items-center table-sm" id="tableMonthlyReport">
                        <thead class="thead-light">
                        <tr>
                            <th> מנוף</th>
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
                'excelHtml5',
                'print',
            ],
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Hebrew.json",
                search: "",
            }
        });

        var reportTable = $('#tableMonthlyReport').DataTable({
            dom: 'B',
            paginate: false,
            buttons: [
                'excelHtml5',
                'print',
            ],
        });


        function openMonthAttModel(project) {
            $.ajax({
                type: 'POST',
                url: '{{route('project.ajax.four')}}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    project: project,
                },
                success: function (data) {


                    reportTable.clear().draw();
                    for (var i = 0; i < data.data.length; i++) {
                        reportTable.row.add([data.data[i].crane, data.data[i].hour_count]).draw(false);
                    }
                    $('#monthAttModel').modal('show');

                }
            });
        }
    </script>

@endpush
