@extends('layouts.app')

@push('title')
    عرض معلومات المشروع
@endpush

@push('pg_btn')
    <a href="{{route('project.index')}}" class="btn btn-sm btn-neutral">جميع المشاريع</a>
@endpush


@push('styles')
    <style>

        iframe {
            width: 100%;
            height: 700px;
            overflow: hidden;
            border: none;
            /*            box-shadow: 0 0 2rem 0 rgb(136 152 170 / 15%);
                        border-radius: 0.375rem;*/
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
                                    <i class="fas fa-info-circle"></i> معلومات المشروع</a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-cranes-tab" data-toggle="tab"
                                   href="#cranes" role="tab">
                                    <i class="fa fa-building"></i> الرافعات </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-cranes-tab" data-toggle="tab"
                                   href="#reports" role="tab">
                                    <i class="far fa-sticky-note"></i> تقارير الحضور </a>
                            </li>

                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-files-tab" data-toggle="tab"
                                   href="#files" role="tab">
                                    <i class="fas fa-project-diagram"></i> ملفات خاصة بالمشروع </a>
                            </li>

                        </ul>
                    </div>
                    <hr class="m-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">

                                <div class="tab-pane fade show active" id="info" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4">معلومات المشروع</h4>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#statusModal">
                                            לשׁנות حالة المشروع
                                        </button>
                                    </div>

                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-control-label">اسم المشروع </label>
                                                    <input type="text" class="form-control" id="name"
                                                           value="{{$project->name}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">عنوان
                                                        المشروع </label>
                                                    <input type="text" class="form-control" id="address"
                                                           value="{{$project->address}}" readonly>
                                                </div>
                                            </div>

                                            {{--                                            <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label for="start_date" class="form-control-label"> تاريخ بدء
                                                                                                    المشروع </label>
                                                                                                <input type="date" class="form-control" id="start_date"
                                                                                                       value="{{$project->start_date}}" readonly>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-lg-6">
                                                                                            <div class="form-group">
                                                                                                <label for="end_date" class="form-control-label"> تاريخ انتهاء
                                                                                                    المشروع</label>
                                                                                                <input type="date" class="form-control" id="end_date"
                                                                                                       value="{{$project->end_date}}" readonly>
                                                                                            </div>
                                                                                        </div>--}}

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="hour_cost" class="form-control-label"> سعر
                                                        الساعة </label>
                                                    <input type="text" class="form-control" id="hour_cost"
                                                           value="{{$project->hour_cost}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="manager_id" class="form-control-label"> مدير
                                                        المشروع </label>
                                                    <input type="text" class="form-control" id="hour_cost"
                                                           value="{{$project->manager->name}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="manager_id" class="form-control-label"> حالة
                                                        المشروع </label>
                                                    <input type="text" class="form-control" id="hour_cost"
                                                           value="{{ __('messages.status.'.$project->status)}}"
                                                           readonly>
                                                </div>
                                            </div>
                                        </div>
                                    </div>


                                </div>

                                <div class="tab-pane fade" id="cranes" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4"> الرافعات</h4>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#craneModal">
                                            اضافة رافعة جديدة
                                        </button>
                                    </div>
                                    <div class="pl-lg-4">

                                        <div class="table-responsive">
                                            <div>
                                                <table class="table align-items-center">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>الاسم</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($project->cranes as $crane)
                                                        <tr>
                                                            <td>{{$crane->name}}</td>
                                                        </tr>
                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="files" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4"> ملفات خاصة بالمشروع</h4>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="row" id="file-manager">
                                            <div class="col-md-12">
                                                <iframe src="/filemanager"></iframe>
                                            </div>
                                        </div>
                                    </div>
                                </div>


                                <div class="tab-pane fade" id="reports" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4">تقارير الحضور</h4>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-md-6 col-12 border-right">
                                                <h3>تقارير حضور العمال</h3>
                                                <div class="table-responsive">
                                                    <div>
                                                        <table class="table align-items-center">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>العامل</th>
                                                                <th>عدد الساعات</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($workersAtt as $att)
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
                                                <h3>تقارير الساعات الشهري</h3>
                                                <div class="table-responsive">
                                                    <div>
                                                        <table class="table align-items-center">
                                                            <thead class="thead-light">
                                                            <tr>
                                                                <th>الشهر</th>
                                                                <th>عدد الساعات</th>
                                                                <th>معلومات </th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                            @foreach($monthAtt as $att)
                                                                <tr>
                                                                    <td>{{$att->date}}</td>
                                                                    <td>{{$att->total}}</td>
                                                                    <td>
                                                                        <button class="btn btn-sm btn-primary"
                                                                                onclick="openMonthAttModel('{{$att->date}}',{{$project->id}})">
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
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="statusModal" >
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('client.project.store',$project->id)}}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> تعديل حالة المشروع</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="status" class="form-control-label">حالة المشروع </label>
                                    <select name="status" class="custom-select" id="status">
                                        {{--<option value="pending">{{ __('messages.status.pending')}}</option>--}}
                                        <option value="canceled">{{ __('messages.status.canceled')}}</option>
                                        <option value="completed">{{ __('messages.status.completed')}}</option>
                                    </select>
                                </div>
                            </div>
                        </div>

                        <div class="alert alert-danger" role="alert">
                            <span class="alert-text">
                                تحذير : لا يمكن الرجوع الى الوضع السابق في حال تعديلحالة المشروع !
                            </span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">לשׁנות</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="craneModal">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('project.crane.store',$project->id)}}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة رافعة جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">اسم الرافعة </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">الغاء</button>
                        <button type="submit" class="btn btn-primary">اضافة</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="monthAttModel">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">معلومات العمل</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>

                <div class="modal-body">
                    <table class="table align-items-center" id="tableMonthAtt">
                        <thead class="thead-light">
                        <tr>
                            <th>العامل</th>
                            <th>عدد الساعات</th>
                        </tr>
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                </div>

                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-dismiss="modal">اغلاق</button>
                </div>

            </div>
        </div>
    </div>

@endsection

@push('scripts')
    <script>

        $('#tabs a').on('click',function(e) {
            e.preventDefault();
            $(this).tab('show');
        });

        $("ul > li > a").on("shown.bs.tab", function(e) {
            var id = $(e.target).attr("href").substr(1);
            window.location.hash = id;
        });

        var hash = window.location.hash;
        $('#tabs a[href="' + hash + '"]').tab('show')


        function openMonthAttModel(month,project) {
            $("#tableMonthAtt").find("tr:gt(0)").remove();
            $.ajax({
                type: 'POST',
                url: '{{route('project.ajax.one')}}',
                dataType: 'json',
                data: {
                    _token: "{{ csrf_token() }}",
                    month: month,
                    project: project,
                },
                success: function (data) {
                    for(var i = 0; i < data.length; i++) {
                        var html = '<tr>';
                        html += '<td>'+data[i].name+'</td>';
                        html += '<td>'+data[i].total+'</td></tr>';
                        $('#tableMonthAtt').prepend(html);
                    }
                    $('#monthAttModel').modal('show');


                }
            });
        }

    </script>
@endpush
