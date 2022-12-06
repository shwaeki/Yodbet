@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/dist/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/dist/css/select2-bootstrap4.min.css')}}"
          type="text/css">
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
                    <form action="{{route('attendance.store')}}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">מידע על לוח נוכחות עובדים</h6>
                        <div class="pl-lg-4">
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="project_id" class="form-control-label"> פרויקט </label>
                                        {{ Form::select('project_id', $projects,old('project_id',request('project')), [ 'id' => 'project_id' , 'class'=> 'selectpicker form-control','required' => 'required', 'placeholder' => 'اختر المشروع ...']) }}
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="date" class="form-control-label"> תאריך </label>
                                        <input type="month" class="form-control" id="date" name="date"
                                               value="{{request('month') }}" min="{{$minMonth}}"
                                               max="{{$maxMonth}}" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="crane_id" class="form-control-label"> מנוף </label>
                                        {{ Form::select('crane_id',  $project?->cranes()->pluck('name', 'id') ?? [],old('crane_id',request('crane')), [ 'id' => 'crane_id' , 'class'=> 'selectpicker form-control','required' => 'required', 'placeholder' => 'اختر الرافعة ...']) }}
                                    </div>
                                </div>


                            </div>
                            @if($project)
                                <div class="row py-4 bg-primary text-white rounded-lg mb-4">
                                    <div class="col-3 d-flex align-items-center">
                                        מנהל הפרויקט : {{$project->manager->name ?? ''}}
                                    </div>
                                    <div class="col-3 d-flex align-items-center">
                                        סטאטוס : {{$project->status}}
                                    </div>
                                    <div class="col-3 d-flex flex-fill align-items-center">
                                        <span class="flex-shrink-0 mr-3">   עובד קבוע:</span>
                                        <select class="form-control searchSelect" id="mainWorker" aria-label="Worker">
                                            <option value="">בחר עובד ...</option>
                                        </select>
                                        <button type="button" id="selectWorker" class="btn btn-neutral ml-3 py-2"> בחר
                                        </button>
                                    </div>

                                    <div class="col-3 d-flex justify-content-end">
                                        <button type="button" class="btn btn-neutral ml-3 py-2" data-toggle="modal"
                                                data-target="#addWorkerModel">
                                            הוסף עובד
                                        </button>


                                    </div>

                                </div>
                            @endif
                            @if($project && $daysCount && request('crane') )
                                <div class="table-responsive">
                                    <div>
                                        <table class="table align-items-center table-sm table-striped"
                                               id="AttendanceTable">
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
                                                <td class="text-right" colspan="4"><h4 class="mb-0">סך הכול שעות: <span class="totalHours">0</span></h4></td>
                                            </tr>
                                            @for ($day = 1; $day <=$daysCount ; $day++)
                                                @php
                                                    $attendance = null;
                                                     $date = request('month').'-'.str_pad($day,2,'0',STR_PAD_LEFT);
                                                     $dayname = date('l', strtotime($date));
                                                    if ($projectAttendance){
                                                        $attendance = $projectAttendance->where('date', $date)->first();
                                                    }
                                                @endphp

                                                <tr @class(['table-success' => $attendance, 'table-danger' => $dayname == "Saturday",])>
                                                    @if($dayname != "Saturday")

                                                        <td>{{$day}}</td>
                                                        <td>
                                                            {{$date}}
                                                            <input type="hidden" name="attendance[{{$day}}][date]"
                                                                   id="date" value="{{$date}}">
                                                        </td>
                                                        <td>
                                                            <select class="searchSelect form-control"
                                                                    name="attendance[{{$day}}][worker]"
                                                                    aria-label="Worker">
                                                                <option value="">בחר עובד ...</option>
                                                                @if($attendance)
                                                                    <option value="{{$attendance->worker->id}}"
                                                                            selected>
                                                                        {{$attendance->worker->name}}
                                                                        - {{$attendance->worker->identification}}
                                                                    </option>
                                                                @endif
                                                            </select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" name="attendance[{{$day}}][hours]"
                                                                       aria-label="Hour Count" step="0.01"
                                                                       class="form-control hours"
                                                                       value="{{ $attendance->hour_work_count ??'' }}">
                                                                <div class="input-group-append">
                                                                <span class="input-group-text"
                                                                      style="font-size: inherit !important;">שעות</span>
                                                                </div>
                                                            </div>
                                                        </td>
                                                    @else
                                                        <td>{{$day}}</td>
                                                        <td>{{$date}}</td>
                                                        <td></td>
                                                        <td></td>

                                                    @endif
                                                </tr>

                                            @endfor

                                            @foreach ($extraAttendance as $extra)
                                                <tr class="table-info">

                                                    <td>{{($day+$loop->index)}}</td>
                                                    <td>
                                                        {{$extra->date}}
                                                        <input type="hidden"
                                                               name="attendance[{{($day+$loop->index)}}][date]"
                                                               value="{{$extra->date}}">
                                                        <input type="hidden" id="date"
                                                               name="attendance[{{($day+$loop->index)}}][extra]"
                                                               value="1">
                                                    </td>
                                                    <td>
                                                        <select class="searchSelect form-control"
                                                                name="attendance[{{($day+$loop->index)}}][worker]"
                                                                aria-label="Worker">
                                                            <option value="">בחר עובד ...</option>
                                                            <option value="{{$extra->worker->id}}"
                                                                    selected>
                                                                {{$extra->worker->name}}
                                                                - {{$extra->worker->identification}}
                                                            </option>
                                                        </select>
                                                    </td>
                                                    <td>
                                                        <div class="input-group input-group-sm">
                                                            <input type="number"
                                                                   name="attendance[{{($day+$loop->index)}}][hours]"
                                                                   aria-label="Hour Count"
                                                                   class="form-control hours"
                                                                   value="{{ $extra->hour_work_count ??'' }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"
                                                                      style="font-size: inherit !important;">שעות</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach

                                            </tbody>
                                        </table>
                                       <h4 class="mb-0 mx-4 pt-2 border-top text-right">סך הכול שעות: <span class="totalHours">0</span></h4>
                                    </div>
                                </div>
                            @endif

                            <button type="button" onclick="addRow()" class="btn btn-success my-3">+</button>
                        </div>
                        <hr class="m-1">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-3 btn btn-primary">לעתכן</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <form id="monthFom">
        <input type="hidden" id="month" name="month" value="">
        <input type="hidden" id="project" name="project" value="">
        <input type="hidden" id="crane" name="crane" value="">
    </form>


    <div class="modal fade" id="addWorkerModel">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <form action="" id="addWorkerForm">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> הוסף עובד</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">

                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">שם </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}" required>
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="hour_cost" class="form-control-label"> מחיר לשעה </label>
                                    <input type="text" class="form-control only-number" id="hour_cost" name="hour_cost"
                                           value="{{old('hour_cost')}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="phone1" class="form-control-label"> מספר טלפו</label>
                                    <input type="text" class="form-control only-number" id="phone1" name="phone1"
                                           value="{{old('phone1')}}" maxlength="10">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="identification" class="form-control-label">מספר תעודת זהות</label>
                                    <input type="text" class="form-control only-number" id="identification"
                                           name="identification" maxlength="9"
                                           value="{{old('identification')}}">
                                </div>
                            </div>


{{--
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="start_work_date" class="form-control-label"> תאריך תחילת העבודה </label>
                                    <input type="date" class="form-control" id="start_work_date" name="start_work_date"
                                           value="{{old('start_work_date')}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="end_work_date" class="form-control-label"> תאריך סיום העבודה </label>
                                    <input type="date" class="form-control" id="end_work_date" name="end_work_date"
                                           value="{{old('end_work_date')}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="license_expiration_date" class="form-control-label">תאריך תפוגה של
                                        הרישיון </label>
                                    <input type="date" class="form-control" id="license_expiration_date"
                                           name="license_expiration_date"
                                           value="{{old('license_expiration_date')}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="course_date" class="form-control-label"> תאריך הקורס </label>
                                    <input type="date" class="form-control" id="course_date" name="course_date"
                                           value="{{old('course_date')}}">
                                </div>
                            </div>

                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label for="course_end_date" class="form-control-label">תאריך סיום הקורס</label>
                                    <input type="date" class="form-control" id="course_end_date"
                                           name="course_end_date"
                                           value="{{old('course_end_date')}}">
                                </div>
                            </div>--}}


                        </div>

                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">ביטול</button>
                        <button type="submit" class="btn btn-primary">הוסף</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

@endsection



@push('scripts')
    <script src="{{asset('assets/vendor/select2/dist/js/select2.full.min.js')}}"></script>

    <script>


        $('body').on('keydown', 'input, select', function (e) {
            if (e.key === "Enter") {
                var self = $(this), form = self.parents('form:eq(0)'), focusable, next;
                focusable = form.find('input').filter(':visible');
                next = focusable.eq(focusable.index(this) + 1);
                if (next.length) {
                    next.focus();
                }
                return false;
            }
        });

        function addRow() {
            let index = $('#AttendanceTable tr').length;
            $('#AttendanceTable > tbody:last-child').append(`<tr>
                                                        <td>` + index + `</td>
                                                        <td>
                                                            <input type="date" class="form-control form-control-sm"
                                                                name="attendance[` + index + `][date]" required>
                                                            <input type="hidden" name="attendance[` + index + `][extra]" value="1">
                                                        </td>
                                                        <td>
                                                             <select class="searchSelect form-control form-control-sm"
                                                                    name="attendance[` + index + `][worker]"
                                                                    aria-label="Worker" required>
                                                                <option value="">בחר עובד ...</option>
                                                               </select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" name="attendance[` + index + `][hours]" aria-label="Hour Count" class="form-control hours" step="0.01" required>
                                                                <div class="input-group-append">
                                                                <span class="input-group-text" style="font-size: inherit !important;">שעות</span>
                                                                </div>
                                                            </div>
                                                        </td>
        </tr>`);

            $('select[name="attendance[' + index + '][worker]"]').select2({
                theme: 'bootstrap4',
                // placeholder: 'בחר עובד..',
                minimumInputLength: 2,
                ajax: {
                    url: "{{route('worker.ajax')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name + " - " + item.identification,
                                    id: item.id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        }


        $(document).ready(function () {
            $(document).on("input",'.hours', function() {
                var total = 0;
                $('.hours').each(function(){total += +$(this).val();});
                $('.totalHours').html(total);
            });

            $("#addWorkerForm").on("submit", function (event) {
                event.preventDefault();
                var data = getFormData( $(event.target) );
                data['_token'] = "{{ csrf_token() }}";
                $.ajax({
                    type: 'POST',
                    url: '{{route('worker.store.ajax')}}',
                    dataType: 'json',
                    data: data,
                    success: function (data) {
                        if(data.status === true){
                            Swal.fire(
                                'עובד חדש נוסף בהצלחה.',
                                '',
                                'success'
                            )
                        }
                        $('#addWorkerModel').modal('hide');
                        console.log(data);
                    }
                });
                console.log(data);
            });


            $("#selectWorker").on("click", function () {
                var data = $('#mainWorker').select2('data')
                var name = data[0].text;
                var id = data[0].id;

                $('.searchSelect').each(function () {
                    if ($(this).find("option[value=" + id + "]").length) {
                        $(this).val(id).trigger("change");
                    } else {
                        var newState = new Option(name, id, true, true);
                        $(this).append(newState).trigger('change');
                    }
                })
            });


            $('#date, #project_id, #crane_id').on('change', function () {
                var date = $('#date').val();
                var project_id = $('#project_id').val();
                var crane_id = $('#crane_id').val();
                if (project_id && crane_id && date) {
                    $('#monthFom #month').val(date);
                    $('#monthFom #project').val(project_id);
                    $('#monthFom #crane').val(crane_id);
                    $('#monthFom').submit();
                } else if (project_id && date) {
                    $('#monthFom #month').val(date);
                    $('#monthFom #project').val(project_id);
                    $('#monthFom').submit();
                }
                if (this.value === "" || this.value == null) {
                    $('#monthFom #month').val(null);
                    $('#monthFom #project').val(null);
                    $('#monthFom #crane').val(null);
                    $('#monthFom').submit();
                }
            });

            $('.searchSelect').select2({
                theme: 'bootstrap4',
                // placeholder: 'בחר את  העובד..',
                minimumInputLength: 2,
                ajax: {
                    url: "{{route('worker.ajax')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name + " - " + item.identification,
                                    id: item.id,
                                }
                            })
                        };
                    },
                    cache: true
                }
            });

            $('.searchSelect').on('select2:select', function (e) {
                var select = $(e.currentTarget);
                var worker_id = e.params.data.id;
                var date = select.parent().parent().find('#date').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('worker.data.status') }}",
                    data: {worker: worker_id, date: date},
                    success: function (data) {
                        if (data.status === false) {
                            select.val(null).trigger("change");
                            Swal.fire(
                                'שגיאה!',
                                'עובד אינו יכול לעבוד באותו יום ביותר מאתר עבודה אחד!',
                                'error'
                            )
                        }
                    }
                });

            });


        })
    </script>

@endpush
