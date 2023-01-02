@extends('layouts.app')


@push('title')
    דוח  מקדמות
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

                    <h6 class="heading-small text-muted mb-4">דוח מקדמות</h6>
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
                                    <table class="table align-items-center table-sm table-striped"
                                           id="ReportTable">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>שם העובד</th>
                                            <th>תאריך</th>
                                            <th>סך הכל</th>
                                            <th>סטאטוס</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @php($totalPaid = 0)
                                        @php($totalUnPaid = 0)
                                        @foreach($data as $item)
                                            <tr>
                                                <td>{{$loop->index +1}}</td>
                                                <td>{{$item->worker->name}}</td>
                                                <td>{{$item->payment_date}}</td>
                                                <td>@money($item->amount)</td>
                                                <td>
                                                    @if($item->paid == true)
                                                        <span class="badge badge-success">שולם</span>
                                                        @php($totalPaid += $item->amount)
                                                    @else
                                                        <span class="badge badge-danger">לא משולם</span>
                                                        @php($totalUnPaid += $item->amount)
                                                    @endif
                                                </td>
                                            </tr>
                                        @endforeach


                                        </tbody>
                                    </table>
                            </div>

                            <div class="row text-success">
                                <div class="col">
                                    סך הכל שולם
                                </div>
                                <div class="col">
                                    @money($totalPaid)
                                </div>
                            </div>

                            <div class="row text-danger">
                                <div class="col">
                                    סך הכל לא משולם
                                </div>
                                <div class="col">
                                    @money($totalUnPaid)
                                </div>
                            </div>

                        @endif

                    </div>
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

        $('#month').on('change', function () {
            $('#monthFom').submit();
        });

        $('#ReportTable').DataTable({
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
    </script>

@endpush
