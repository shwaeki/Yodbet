@extends('layouts.app')

@push('title')
    הצג את פרטי העובד
@endpush

@push('pg_btn')
    <a href="{{route('worker.index')}}" class="btn btn-sm btn-neutral">כל העובדים</a>
@endpush

@push('styles')
    <style>

        iframe {
            width: 100%;
            height: 700px;
            overflow: hidden;
            border: none;
            box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);
            border-radius: 0.375rem;
        }

        #fab a {
            color: white !important;
        }
    </style>
@endpush

@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <div class="nav-wrapper p-0">
                        <ul class="nav nav-pills flex-column flex-md-row" id="tabs" role="tablist">
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0 active" id="tabs-info-tab" data-toggle="tab"
                                   href="#info" role="tab">
                                    <i class="fas fa-info-circle"></i> מידע על עובד </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-cranes-tab" data-toggle="tab"
                                   href="#reports" role="tab">
                                    <i class="far fa-sticky-note"></i> דוחות נוכחות </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-advance-tab" data-toggle="tab"
                                   href="#advance" role="tab">
                                    <i class="fas fa-coins"></i> מקדמות </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-files-tab" data-toggle="tab"
                                   href="#files" role="tab">
                                    <i class="fas fa-project-diagram"></i> תיקים פרטיים של עובדים </a>
                            </li>

                        </ul>
                    </div>
                    <hr class="m-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4">מידע על עובד</h4>
                                    </div>

                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-control-label"> שם</label>
                                                    <input type="text" class="form-control" id="name"
                                                           value="{{$worker->name}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">אימייל</label>
                                                    <input type="email" class="form-control" id="email"
                                                           value="{{$worker->email}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone1" class="form-control-label"> מספר טלפו</label>
                                                    <input type="text" class="form-control" id="phone1"
                                                           value="{{$worker->phone1}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone2" class="form-control-label">מספר טלפון
                                                        לגיבוי</label>
                                                    <input type="text" class="form-control" id="phone2"
                                                           value="{{$worker->phone2}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="identification" class="form-control-label">מספר תעודת
                                                        זהות</label>
                                                    <input type="text" class="form-control" id="identification"
                                                           value="{{$worker->identification}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="hour_cost" class="form-control-label"> מחיר
                                                        לשעה </label>
                                                    <input type="text" class="form-control" id="hour_cost"
                                                           value="{{$worker->hour_cost}}" disabled>
                                                </div>
                                            </div>


                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="start_work_date" class="form-control-label"> תאריך תחילת
                                                        העבודה </label>
                                                    <input type="date" class="form-control" id="start_work_date"
                                                           value="{{$worker->start_work_date}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="end_work_date" class="form-control-label"> תאריך סיום
                                                        העבודה </label>
                                                    <input type="date" class="form-control" id="end_work_date"
                                                           value="{{$worker->end_work_date}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="license_expiration_date" class="form-control-label">
                                                        תאריך תפוגה של הרישיון </label>
                                                    <input type="date" class="form-control" id="license_expiration_date"
                                                           value="{{$worker->license_expiration_date}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="course_date" class="form-control-label"> תאריך
                                                        הקורס </label>
                                                    <input type="date" class="form-control" id="course_date"
                                                           value="{{ $worker->course_date}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="course_end_date" class="form-control-label">תאריך סיום
                                                        הקורס</label>
                                                    <input type="date" class="form-control" id="course_end_date"
                                                           value="{{$worker->course_end_date}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="number" class="form-control-label"> מספר עובד </label>
                                                    <input type="text" class="form-control" id="number" name="number"
                                                           value="{{$worker->number}}" disabled>
                                                </div>
                                            </div>


                                        </div>
                                    </div>


                                </div>

                                <div class="tab-pane fade" id="reports" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4">דוחות נוכחות</h4>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-md-6 col-12 border-right">
                                                <h3>דוחות נוכחות לפרויקטים</h3>
                                                <div class="table-responsive">
                                                    <div>
                                                        <table class="table align-items-center">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>הפרויקט</th>
                                                                <th>מספר השעות</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($projectAtt as $att)
                                                                <tr>
                                                                    <td>{{$att->name}}</td>
                                                                    <td>{{$att->total}}</td>
                                                                </tr>
                                                            @endforeach
                                                            </tbody>
                                                        </table>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="col-md-6 col-12">
                                                <h3>דוחות שעות חודשיים</h3>
                                                <div class="table-responsive">
                                                    <table class="table align-items-center">
                                                        <thead class="thead-light">
                                                        <tr>
                                                            <th>החודש</th>
                                                            <th>מספר השעות</th>
                                                            <th>מידע</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @foreach($monthAtt as $att)
                                                            <tr>
                                                                <td>{{$att->date}}</td>
                                                                <td>{{$att->total}}</td>
                                                                <td>
                                                                    <button class="btn btn-sm btn-primary"
                                                                            onclick="openMonthAttModel('{{$att->date}}',{{$worker->id}})">
                                                                        פרויקטים
                                                                    </button>
                                                                    <button class="btn btn-sm btn-primary"
                                                                            onclick="openMonthReportModel('{{$att->date}}',{{$worker->id}})">
                                                                        שעות
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

                                <div class="tab-pane fade" id="advance" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4">מקדמות</h4>
                                        <button type="button" class="btn btn-primary btn-sm"
                                                data-toggle="modal" data-target="#advanceModal">הוסף מקדמה
                                        </button>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="table-responsive">
                                            <table class="table align-items-center">
                                                <thead class="thead-light">
                                                <tr>
                                                    <th>תאריך</th>
                                                    <th>סך הכול</th>
                                                    <th>סטאטוס</th>
                                                    <th>אפשרויות</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                @foreach($advances as $advance)
                                                    <tr>
                                                        <td>{{$advance->payment_date}}</td>
                                                        <td>{{$advance->amount}}</td>
                                                        <td>
                                                            @if($advance->paid)
                                                                <span class="badge badge-success">שולם</span>
                                                            @else
                                                                <span class="badge badge-danger"> לא שולם</span>
                                                            @endif
                                                        </td>
                                                        <td>
                                                            @if(!$advance->paid)
                                                                <div class="space-x-2">
                                                                    <a data-toggle="modal"
                                                                       data-target="#editAdvanceModal_{{$advance->id}}"
                                                                       class="btn edit btn-primary text-white btn-sm m-1"></a>
                                                                </div>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                    @if(!$advance->paid)
                                                        <div class="modal fade" id="editAdvanceModal_{{$advance->id}}">
                                                            <div class="modal-dialog" role="document">
                                                                <div class="modal-content">
                                                                    <form action="{{route('advance.details.update',['id'=>$advance->id])}}" method="POST">
                                                                        @csrf
                                                                        @method('PUT')
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="exampleModalLabel">עתכון סטאטוס</h5>
                                                                            <button type="button" class="close"
                                                                                    data-dismiss="modal"
                                                                                    aria-label="Close">
                                                                                <span aria-hidden="true">&times;</span>
                                                                            </button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <div class="row">
                                                                                <div class="col-12">
                                                                                    <div class="form-group">
                                                                                        <label for="paid"
                                                                                               class="form-control-label">
                                                                                            סטאטוס </label>
                                                                                        <select class="form-control"
                                                                                                id="paid"
                                                                                                name="paid" required>
                                                                                            <option value="1">שולם
                                                                                            </option>
                                                                                        </select>
                                                                                    </div>
                                                                                </div>

                                                                            </div>

                                                                            <div class="modal-footer">
                                                                                <button type="button"
                                                                                        class="btn btn-secondary"
                                                                                        data-dismiss="modal">סגור
                                                                                </button>
                                                                                <button type="submit"
                                                                                        class="btn btn-primary">שמור
                                                                                </button>
                                                                            </div>
                                                                        </div>
                                                                    </form>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>

                                    </div>
                                </div>


                                <div class="tab-pane fade" id="files" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4">תיקים פרטיים של עובדים</h4>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="row" id="file-manager">
                                            <div class="col-md-12">
                                                <iframe src="/filemanager"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>

    <div class="modal fade" id="advanceModal">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <form action="{{route('advance.store')}}" method="POST">
                    @csrf
                    <input type="hidden" name="worker_id" value="{{$worker->id}}">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">הוסף מקדמה</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="start_date" class="form-control-label">תאריך התחלה </label>
                                    <input type="date" class="form-control" id="start_date" name="start_date"
                                           value="{{old('start_date')}}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="payments" class="form-control-label"> תשלומים</label>
                                    <input type="text" class="form-control only-number" id="payments" name="payments"
                                           value="{{old('payments')}}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="total" class="form-control-label"> סך הכל</label>
                                    <input type="text" class="form-control  only-number" id="total" name="total"
                                           value="{{old('total')}}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <p id="notes"></p>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">סגור</button>
                            <button type="submit" class="btn btn-primary">שמור</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="monthAttModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">מידע על פרויקטים</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table align-items-center" id="tableMonthAtt">
                        <thead class="thead-light">
                        <tr>
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

    <div class="modal fade" id="monthReportModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">מידע על שעות עבודה</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table align-items-center">
                        <thead class="thead-light">
                        <tr>
                            <th>סיג</th>
                            <th>כמות</th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr>
                            <td>שעות רגילות</td>
                            <td id="hours_normal"></td>
                        </tr>
                        <tr>
                            <td>שעות 125%</td>
                            <td id="hours_125"></td>
                        </tr>
                        <tr>
                            <td>שעות 150%</td>
                            <td id="hours_150"></td>
                        </tr>
                        <tr>
                            <td>שעות בונוס</td>
                            <td id="hours_bonus"></td>
                        </tr>
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
    <script>
        $('#total, #payments').on('input', function (e) {
            var payments = parseInt($('#payments').val());
            var total = parseInt($('#total').val());
            if (payments > 0 && total > 0) {
                var toPay = total / payments
                $('#notes').html('צריך לשלם ' + toPay.toFixed(2) + ' כל חודש במשך ' + payments + ' חודשים')
            }
        });

        $('#tabs a').on('click', function (e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $("ul > li > a").on("shown.bs.tab", function (e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        var hash = window.location.hash;
        $('#tabs a[href="' + hash + '"]').tab('show')

        function openMonthAttModel(month, worker) {
            $("#tableMonthAtt").find("tr:gt(0)").remove();
            $.ajax({
                type: 'POST',
                url: '{{route('project.ajax.two')}}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    month: month,
                    worker: worker,
                },
                success: function (data) {
                    for (var i = 0; i < data.length; i++) {
                        var html = '<tr>';
                        html += '<td>' + data[i].name + '</td>';
                        html += '<td>' + data[i].total + '</td></tr>';
                        $('#tableMonthAtt').prepend(html);
                    }
                    $('#monthAttModel').modal('show');

                }
            });
        }

        function openMonthReportModel(month, worker) {
            $.ajax({
                type: 'POST',
                url: '{{route('worker.report.monthly')}}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    month: month,
                    worker: worker,
                },
                success: function (data) {
                    console.log(data);
                    for (var k in data) {
                        $('#' + k + '').html(data[k]);
                    }
                    $('#monthReportModel').modal('show');

                }
            });
        }
    </script>
@endpush



