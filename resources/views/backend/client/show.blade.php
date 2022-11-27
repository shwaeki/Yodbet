@extends('layouts.app')

@push('title')
    عرض معلومات الزبون
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">جميع الزبائن</a>
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
                                    <i class="fas fa-info-circle"></i> معلومات الزبون</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-projects-tab" data-toggle="tab"
                                   href="#projects" role="tab">
                                    <i class="fas fa-project-diagram"></i> المشاريع </a>
                            </li>

                        </ul>
                    </div>
                    <hr class="m-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">

                                    <h4 class="heading-section text-muted mb-4">معلومات الزبون</h4>
                                    <div class="pl-lg-4">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-control-label">الاسم </label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{old('name',$client->name)}}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">البريد
                                                        الاكتروني </label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           value="{{old('email',$client->email)}}" readonly>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="phone" class="form-control-label"> رقم الهاتف</label>
                                                    <input type="text" class="form-control" id="phone" name="phone"
                                                           value="{{old('phone',$client->phone)}}" readonly>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="taxID" class="form-control-label"> رقم الضريبة</label>
                                                    <input type="text" class="form-control" id="taxID" name="taxID"
                                                           value="{{old('taxID',$client->taxID)}}" readonly>
                                                </div>
                                            </div>

                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted my-4"> جهات الاتصال</h4>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#contactModal">
                                            اضافة جهة اتصال جديدة
                                        </button>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="table-responsive">
                                            <div>
                                                <table class="table align-items-center">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>الاسم</th>
                                                        <th>رقم الهاتف</th>
                                                        <th>الوظيفة</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($client->contacts as $contact)
                                                        <tr>
                                                            <td>{{$contact->name}}</td>
                                                            <td>{{$contact->phone}}</td>
                                                            <td>{{$contact->job_title}}</td>
                                                            <td>
                                                                <div class="space-x-2">
                                                                    <a data-toggle="modal"
                                                                       data-target="#editContactModal_{{$contact->id}}"
                                                                       class="btn edit btn-primary text-white btn-sm m-1"></a>

{{--                                                                    <a href="{{route('client.contact.destroy',[$client->id,$contact->id])}}"
                                                                       class="btn delete btn-primary btn-sm m-1"></a>--}}
                                                                </div>
                                                            </td>

                                                        </tr>

                                                    @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>

                                    </div>
                                </div>
                                <div class="tab-pane fade" id="projects" role="tabpanel">
                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted mb-4"> المشاريع</h4>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{route('client.project.create',$client)}}">
                                            اضافة مشروع جديد
                                        </a>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="table-responsive">
                                            <div>
                                                <table class="table align-items-center">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>اسم المشروع</th>
                                                        <th>العنوان</th>
                                                        <th>سعر الساعة</th>
                                                        <th>مدير المشروع</th>
                                                        <th>تاريخ الانشاء</th>
                                                        <th>الحالة</th>
                                                        <th>خيارات</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($client->projects as $project)
                                                        <tr>


                                                            <td>{{$project->name}}</td>
                                                            <td>{{$project->address}}</td>
                                                            <td>{{$project->hour_cost}}</td>
                                                            <td>{{$project->manager->name}}</td>
                                                            <td>{{ Carbon\Carbon::parse($project->created_at)->format('Y-m-d')}}</td>
                                                            <td>{{ __('messages.status.'.$project->status)}}</td>
                                                            <td>
                                                                <div class="space-x-2">
                                                                    <a href="{{route('project.show',[$project->id])}}"
                                                                       class="btn view btn-primary btn-sm m-1"></a>

                                                                    <a href="{{route('client.project.edit',[$client->id,$project->id])}}"
                                                                       class="btn edit btn-primary btn-sm m-1"></a>

                                              {{--                      <a href="{{route('client.project.destroy',[$client->id,$project->id])}}"
                                                                       class="btn delete btn-primary btn-sm m-1"></a>--}}
                                                                </div>
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

    @foreach($client->contacts as $contact)
        <div class="modal fade" id="editContactModal_{{$contact->id}}" tabindex="-1" role="dialog"
             aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-dialog-centered" role="document">
                <div class="modal-content">
                    <form action="{{route('client.contact.update',[$client->id,$contact->id])}}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="modal-header">
                            <h5 class="modal-title" id="exampleModalLabel"> تعديل جهة الاتصال </h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="name" class="form-control-label">الاسم </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$contact->name}}" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label"> رقم الهاتف</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{$contact->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="job_title" class="form-control-label">المستى الوظيفي </label>
                                        <input type="text" class="form-control" id="job_title" name="job_title"
                                               value="{{$contact->job_title}}" required>
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
    @endforeach

    <div class="modal fade" id="contactModal" tabindex="-1" role="dialog"
         aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered" role="document">
            <div class="modal-content">
                <form action="{{route('client.contact.store',$client->id)}}" method="POST">
                    @csrf

                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel"> اضافة جهة اتصال جديدة</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="name" class="form-control-label">الاسم </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label"> رقم الهاتف</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{old('phone')}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="job_title" class="form-control-label">المستى الوظيفي </label>
                                    <input type="text" class="form-control" id="job_title" name="job_title"
                                           value="{{old('job_title')}}" required>
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
@endsection

@push('scripts')
    <script>
        var hash = window.location.hash;
        $('#tabs a[href="' + hash + '"]').tab('show')
    </script>
@endpush
