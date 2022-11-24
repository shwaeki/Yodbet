@extends('layouts.app')

@push('title')
    عرض معلومات المشروع
@endpush

@push('pg_btn')
    <a href="{{route('project.index')}}" class="btn btn-sm btn-neutral">جميع المشاريع</a>
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
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-projects-tab" data-toggle="tab"
                                   href="#images" role="tab">
                                    <i class="fas fa-project-diagram"></i> صورة خاصة بالمشروع </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-projects-tab" data-toggle="tab"
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
                                            تعديل حالة المشروع
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

                                            <div class="col-lg-6">
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
                                            </div>

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

                                <div class="tab-pane fade" id="images" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4"> صور خاصة بالمشروع</h4>
                                        <a class="btn btn-sm text-white btn-primary"
                                            {{--href="{{route('project.files.create',$project)}}"--}}>
                                            اضافة صورة جديد
                                        </a>
                                    </div>
                                    <div class="pl-lg-4">

                                    </div>
                                </div>

                                <div class="tab-pane fade" id="files" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4"> المشاريع</h4>
                                        <a class="btn btn-sm text-white btn-primary"
                                            {{--href="{{route('project.files.create',$project)}}"--}}>
                                            اضافة ملف جديد
                                        </a>
                                    </div>
                                    <div class="pl-lg-4">

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>


    <div class="modal fade" id="statusModal" tabindex="-1" role="dialog">
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
                        <button type="submit" class="btn btn-primary">تعديل</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        var hash = window.location.hash;
        $('#tabs a[href="' + hash + '"]').tab('show')
    </script>
@endpush
