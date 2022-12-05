@extends('layouts.app')

@push('styles')
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/dist/css/select2.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/select2/dist/css/select2-bootstrap4.min.css')}}"
          type="text/css">
@endpush


@push('title')
    ادارة حضور العاملين
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">رجوع </a>
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">
                    <form action="{{route('attendance.store')}}" method="POST">
                        @csrf
                        <h6 class="heading-small text-muted mb-4">معلومات جدول الحضور</h6>
                        <div class="pl-lg-4">
                            <div class="row">

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="project_id" class="form-control-label"> المشروع </label>
                                        {{ Form::select('project_id', $projects,old('project_id',request('project')), [ 'id' => 'project_id' , 'class'=> 'selectpicker form-control','required' => 'required', 'placeholder' => 'اختر المشروع ...']) }}
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="date" class="form-control-label"> الشهر </label>
                                        <input type="month" class="form-control" id="date" name="date"
                                               value="{{request('month') }}" min="{{$minMonth}}"
                                               max="{{$maxMonth}}" required>
                                    </div>
                                </div>

                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="crane_id" class="form-control-label"> الرافعة </label>
                                        {{ Form::select('crane_id',  $project?->cranes()->pluck('name', 'id') ?? [],old('crane_id',request('crane')), [ 'id' => 'crane_id' , 'class'=> 'selectpicker form-control','required' => 'required', 'placeholder' => 'اختر الرافعة ...']) }}
                                    </div>
                                </div>


                            </div>
                            @if($project)
                                <div class="row py-4 bg-primary text-white rounded-lg mb-4">
                                    <div class="col-3">
                                        مدير المشروع : {{$project->manager->name}}
                                    </div>
                                    <div class="col-3">
                                        حالة المشروع : {{$project->status}}
                                    </div>
                                    {{--                                    <div class="col-3">
                                                                            تاريخ بداية المشروع : {{$project->start_date}}
                                                                        </div>
                                                                        <div class="col-3">
                                                                            تاريخ نهاية المشروع : {{$project->end_date}}
                                                                        </div>--}}
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
                                                <th>التاريخ</th>
                                                <th style="width:30%">الموظف</th>
                                                <th style="width:20%">عدد الساعات</th>
                                            </tr>
                                            </thead>
                                            <tbody>
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
                                                                <option value="">בחר عامل ...</option>
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
                                                                       class="form-control"
                                                                       value="{{ $attendance->hour_work_count ??'' }}">
                                                                <div class="input-group-append">
                                                                <span class="input-group-text"
                                                                      style="font-size: inherit !important;">ساعات</span>
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
                                                            <option value="">בחר عامل ...</option>
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
                                                                   class="form-control"
                                                                   value="{{ $extra->hour_work_count ??'' }}">
                                                            <div class="input-group-append">
                                                                <span class="input-group-text"
                                                                      style="font-size: inherit !important;">ساعات</span>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>

                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            @endif

                            <button type="button" onclick="addRow()" class="btn btn-success my-3">+</button>
                        </div>
                        <hr class="m-1">
                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-3 btn btn-primary">تحديث</button>
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
@endsection


@push('scripts')
    <script src="{{asset('assets/vendor/select2/dist/js/select2.full.min.js')}}"></script>

    <script>

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
                                                                <option value="">בחר عامل ...</option>
                                                               </select>
                                                        </td>
                                                        <td>
                                                            <div class="input-group input-group-sm">
                                                                <input type="number" name="attendance[` + index + `][hours]" aria-label="Hour Count" class="form-control" step="0.01" required>
                                                                <div class="input-group-append">
                                                                <span class="input-group-text" style="font-size: inherit !important;">ساعات</span>
                                                                </div>
                                                            </div>
                                                        </td>
        </tr>`);

            $('select[name="attendance[' + index + '][worker]"]').select2({
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
        }

        $(document).ready(function () {
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
