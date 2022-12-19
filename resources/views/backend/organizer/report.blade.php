@extends('layouts.app')


@push('title')
    דוח סדראנים
@endpush



@push('styles')
    <link href="https://cdn.datatables.net/1.13.1/css/jquery.dataTables.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/1.5.1/css/buttons.dataTables.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap4.min.css" rel="stylesheet"/>
    <link href="https://cdn.datatables.net/buttons/2.3.2/css/buttons.bootstrap4.min.css" rel="stylesheet"/>
    <style>
        .dataTable .sorting_disabled {
            text-align: right;
        }
    </style>
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">

                    <h6 class="heading-small text-muted mb-4">דוח סדראנים</h6>
                    <div class="pl-lg-4">
                        <form id="organizerForm">
                            <div class="row">
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="project_id" class="form-control-label"> סדראן </label>
                                        {{ Form::select('organizer', $organizers,old('organizer',request('organizer')), [ 'id' => 'organizer' , 'class'=> 'selectpicker form-control','required' => 'required', 'placeholder' => 'בחר  ...']) }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="month" class="form-control-label"> תאריך </label>
                                        <input type="month" class="form-control" id="month" name="month"
                                               value="{{request('month',session('mainDate')) }}" required>
                                    </div>
                                </div>
                            </div>
                        </form>
                        @if( isset($organizer) && isset($month))
                            <div class="table-responsive">
                                <div>
                                    <table class="table align-items-center table-sm table-striped"
                                           id="AttendanceTable">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>לקוח</th>
                                            <th>פרויקט</th>
                                            <th> מחיר לשעה לסדראן</th>
                                            <th>מספר שעות</th>
                                            <th> סך הכל</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                        @php($total = 0)
                                        @foreach($organizer->projects  as $project)
                                            @php($totalHours = $project->attendancesDetails()
                                            ->where('attendances.date', '=', $month)->sum('hour_work_count'))
                                            @php($subTotal = $project->organizer->hour_cost*$totalHours)
                                            @php($total += $subTotal)
                                            <tr>
                                                <td>{{$loop->index}}</td>
                                                <td>{{$project->client->name}}</td>
                                                <td>{{$project->name}}</td>
                                                <td>@money($project->organizer->hour_cost)</td>
                                                <td>{{$totalHours}}</td>
                                                <td>@money($subTotal)</td>
                                            </tr>


                                            @if($loop->last)

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-blue font-weight-bolder text-darker">סכ הכול</td>
                                                    <td class="bg-blue font-weight-bolder text-darker">
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="subTotal" value="{{$total}}" readonly>
                                                        <p class="d-none d-print-block">{{$total}}</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-blue font-weight-bolder text-darker">משכורות</td>
                                                    <td class="bg-blue font-weight-bolder text-darker">
                                                        <input type="text" class="form-control form-control-sm"
                                                               value="0" id="salaries">
                                                        <p class="d-none d-print-block" id="salaries_text">0</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-blue font-weight-bolder text-darker">מ.ע</td>
                                                    <td class="bg-blue font-weight-bolder text-darker">
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="sals" value="0">
                                                        <p class="d-none d-print-block" id="sals_text">0</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-blue font-weight-bolder text-darker">מתקדמים</td>
                                                    <td class="bg-blue font-weight-bolder text-darker">
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="advanced" value="0">
                                                        <p class="d-none d-print-block" id="advanced_text">0</p>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-blue font-weight-bolder text-darker d-flex">
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="extra_label">
                                                        <button class="btn btn-sm ml-1 btn-secondary" id="operation"
                                                                onclick="changeOperation()">+
                                                        </button>
                                                    </td>
                                                    <td class="bg-blue font-weight-bolder text-darker">
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="extra" value="0">
                                                    </td>
                                                </tr>

                                                <tr>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td></td>
                                                    <td class="bg-blue font-weight-bolder text-darker">סכ הכול</td>
                                                    <td class="bg-blue font-weight-bolder text-darker">
                                                        <input type="text" class="form-control form-control-sm"
                                                               id="total"
                                                               value="{{$total}}" readonly>
                                                        <p class="d-none d-print-block" id="total_text">0</p>
                                                    </td>
                                                </tr>

                                            @endif
                                        @endforeach


                                        </tbody>
                                    </table>
                                </div>

                            </div>
                            {{--                        <div class="row justify-content-end mt-5">
                                                        <div class="col-4">
                        --}}{{--                                    <div class="row justify-content-end">
                                                                <label for="subTotal" class="col-sm-4 col-form-label">סכ הכול</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control form-control-sm" id="subTotal"
                                                                           value="{{$total}}" readonly>
                                                                </div>
                                                            </div>
                                                            <div class="row justify-content-end">
                                                                <label for="salaries" class="col-sm-4 col-form-label">משכורות</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control form-control-sm"
                                                                           value="0" id="salaries">
                                                                </div>
                                                            </div>--}}{{--

                                                            <div class="row justify-content-end">
                                                                <label for="sals" class="col-sm-4 col-form-label">מ.ע </label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control form-control-sm" id="sals" value="0">
                                                                </div>
                                                            </div>

                                                            <div class="row justify-content-end">
                                                                <label for="advanced" class="col-sm-4 col-form-label">מתקדמים </label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control form-control-sm" id="advanced"
                                                                           value="0">
                                                                </div>
                                                            </div>
                                                            <hr>
                                                            <div class="row justify-content-end">
                                                                <label for="total" class="col-sm-4 col-form-label">סכ הכול</label>
                                                                <div class="col-sm-6">
                                                                    <input type="text" class="form-control form-control-sm" id="total"
                                                                           value="{{$total}}" readonly>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>--}}
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

        function changeOperation() {
            var operation = $('#operation').html();
            if (operation === "+") {
                $('#operation').html('-');
            } else {
                $('#operation').html('+');
            }
            calculateTotal();
        }


        function calculateTotal() {
            var subTotal = parseFloat($('#subTotal').val());
            var salaries = parseFloat($('#salaries').val());
            var advanced = parseFloat($('#advanced').val());
            var sals = parseFloat($('#sals').val());
            var extra = parseFloat($('#extra').val());
            var extraOperation = $('#operation').html();
            $('#total').val(subTotal - salaries - advanced - sals);
            if (extraOperation === "+") {
                $('#total').val(parseFloat($('#total').val()) + extra);
            } else {
                $('#total').val(parseFloat($('#total').val()) - extra);
            }

            $('#total_text').html($('#total').val());
            $('#advanced_text').html(advanced);
            $('#salaries_text').html(salaries);
            $('#sals_text').html(sals);
        }

        $('#AttendanceTable').DataTable({
            dom: 'Bfrtp',
            paginate: false,
            ordering: false,
            buttons: [],
            language: {
                url: "https://cdn.datatables.net/plug-ins/9dcbecd42ad/i18n/Hebrew.json",
                search: "",
            }
        });

        $('#organizer,#month').on('change', function () {
            $('#organizerForm').submit();
        });

        $('#subTotal,#salaries,#advanced,#sals,#extra').on('input', function () {
            calculateTotal();
        });

    </script>

@endpush
