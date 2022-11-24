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
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="project_id" class="form-control-label"> المشروع </label>
                                        {{ Form::select('project_id', $projects,old('project_id',request('project')), [ 'id' => 'project_id' , 'class'=> 'selectpicker form-control','required' => 'required', 'placeholder' => 'اختر المشروع ...']) }}
                                    </div>
                                </div>
                                <div class="col-6">
                                    <div class="form-group">
                                        <label for="date" class="form-control-label"> الشهر </label>
                                        <input type="month" class="form-control" id="date" name="date"
                                               value="{{request('month') }}" min="{{$minMonth}}"
                                               max="{{$maxMonth}}" required>
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
                                    <div class="col-3">
                                        تاريخ بداية المشروع : {{$project->start_date}}
                                    </div>
                                    <div class="col-3">
                                        تاريخ نهاية المشروع : {{$project->end_date}}
                                    </div>
                                </div>
                            @endif
                            <div class="table-responsive">
                                <div>
                                    <table class="table align-items-center table-sm table-striped">
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
                                                if ($projectAttendance){
                                                     $date = request('month').'-'.str_pad($day,2,'0',STR_PAD_LEFT);
                                                     $attendance = $projectAttendance->where('date', $date)->first();
                                                 }
                                            @endphp
                                            <tr class="{{$attendance ? 'table-success' : ''}}">
                                                <td>{{$day}}</td>
                                                <td>
                                                    {{$date}}
                                                    <input type="hidden" name="attendance[{{$day}}][date]"
                                                           value="{{$date}}">
                                                </td>
                                                <td>
                                                    <select class="searchSelect form-control"
                                                            name="attendance[{{$day}}][worker]" aria-label="Worker">
                                                        <option value="">اختار عامل ...</option>
                                                        @if($attendance)
                                                        <option value="{{$attendance->worker->id}}" selected>{{$attendance->worker->name}}</option>
                                                        @endif
                                                    </select>
                                                </td>
                                                <td>
                                                    <div class="input-group ">
                                                        <input type="number" name="attendance[{{$day}}][hours]"
                                                               aria-label="Hour Count"
                                                               class="form-control"
                                                        value="{{ $attendance->hour_work_count ??'' }}">
                                                        <div class="input-group-append">
                                                            <span class="input-group-text">ساعات</span>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endfor
                                        </tbody>
                                    </table>
                                </div>
                            </div>

                        </div>

                        <div class="pl-lg-4">
                            <div class="row">
                                <div class="col-md-12">
                                    <button type="submit" class="mt-5 btn btn-primary">تحديث</button>
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
    </form>
@endsection


@push('scripts')
    <script src="{{asset('assets/vendor/select2/dist/js/select2.full.min.js')}}"></script>

    <script>
        $(document).ready(function () {
            $('#date, #project_id').on('change', function () {
                var data = $('#date ').val();
                var project_id = $('#project_id').val();
                if (project_id && data) {
                    $('#monthFom #month').val(data);
                    $('#monthFom #project').val(project_id);
                    $('#monthFom').submit();
                }
                if (this.value === "" || this.value == null) {
                    $('#monthFom #month').val(null);
                    $('#monthFom #project').val(null);
                    $('#monthFom').submit();
                }
            });

            $('.searchSelect').select2({
                theme: 'bootstrap4',
                // placeholder: 'اختار العامل ..',
                minimumInputLength: 2,
                ajax: {
                    url: "{{route('worker.ajax')}}",
                    dataType: 'json',
                    delay: 250,
                    processResults: function (data) {
                        return {
                            results: $.map(data, function (item) {
                                return {
                                    text: item.name,
                                    id: item.id
                                }
                            })
                        };
                    },
                    cache: true
                }
            });
        })
    </script>

@endpush
