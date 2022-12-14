@extends('layouts.app')

@push('title')
    הצג את פרטי לקוח
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">כל הלקוחות</a>
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
                                    <i class="fas fa-info-circle"></i> מידע ללקוחות </a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link mb-sm-3 mb-md-0" id="tabs-projects-tab" data-toggle="tab"
                                   href="#projects" role="tab">
                                    <i class="fas fa-project-diagram"></i> פרויקטים </a>
                            </li>

                        </ul>
                    </div>
                    <hr class="m-3">
                    <div class="card shadow">
                        <div class="card-body">
                            <div class="tab-content" id="myTabContent">
                                <div class="tab-pane fade show active" id="info" role="tabpanel">

                                    <h4 class="heading-section text-muted mb-4">מידע ללקוחות</h4>
                                    <div class="pl-lg-4">

                                        <div class="row">
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="name" class="form-control-label">שם החשבון </label>
                                                    <input type="text" class="form-control" id="name" name="name"
                                                           value="{{old('name',$client->name)}}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="email" class="form-control-label">דואר אלקטרוני </label>
                                                    <input type="email" class="form-control" id="email" name="email"
                                                           value="{{old('email',$client->email)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="phone" class="form-control-label">טלפון נייד</label>
                                                    <input type="text" class="form-control only-number" id="phone" name="phone"
                                                           value="{{old('phone',$client->phone)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="phone2" class="form-control-label">טלפון</label>
                                                    <input type="text" class="form-control only-number" id="phone2" name="phone2"
                                                           value="{{old('phone2',$client->phone2)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="taxID" class="form-control-label">ח.פ</label>
                                                    <input type="text" class="form-control only-number" id="taxID" name="taxID"
                                                           value="{{old('taxID',$client->taxID)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="city" class="form-control-label">עיר </label>
                                                    <input type="text" class="form-control" id="city" name="city"
                                                           value="{{old('city',$client->city)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-3">
                                                <div class="form-group">
                                                    <label for="address" class="form-control-label">כתובת </label>
                                                    <input type="text" class="form-control" id="address" name="address"
                                                           value="{{old('address',$client->address)}}" disabled>
                                                </div>
                                            </div>

                                            <div class="col-lg-6">
                                                <div class="form-group">
                                                    <label for="client_key" class="form-control-label">מפתח חשבון </label>
                                                    <input type="text" class="form-control only-number" id="client_key" name="client_key"
                                                           value="{{old('client_key',$client->client_key)}}" disabled>
                                                </div>
                                            </div>


                                        </div>
                                    </div>

                                    <div class="d-flex align-items-center justify-content-between">
                                        <h4 class="heading-section text-muted my-4">אנשי קשר</h4>
                                        <button type="button" class="btn btn-sm btn-primary" data-toggle="modal"
                                                data-target="#contactModal">
                                            הוסף איש קשר חדש
                                        </button>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="table-responsive">
                                            <div>
                                                <table class="table align-items-center">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>שם</th>
                                                        <th>מספר הטלפון	</th>
                                                        <th>המשרה</th>
                                                        <th>אפשרויות</th>
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
                                        <h4 class="heading-section text-muted mb-4"> פרויקטים</h4>
                                        <a class="btn btn-sm btn-primary"
                                           href="{{route('client.project.create',$client)}}">
                                            הוסף פרויקט חדש
                                        </a>
                                    </div>
                                    <div class="pl-lg-4">
                                        <div class="table-responsive">
                                            <div>
                                                <table class="table align-items-center">
                                                    <thead class="thead-light">
                                                    <tr>
                                                        <th>שם הפרוייקט</th>
                                                        <th>מספר מנופות</th>
                                                        <th>הכתובת</th>
                                                        <th>מחיר לשעה</th>
                                                        <th>מנהל פרוייקט</th>
                                                        <th>תאריך יצירה</th>
                                                        <th>המצב</th>
                                                        <th>אפשרויות</th>
                                                    </tr>
                                                    </thead>
                                                    <tbody>
                                                    @foreach($client->projects as $project)
                                                        <tr>
                                                            <td>{{$project->name}}</td>
                                                            <td>{{$project->cranes()->count()}}</td>
                                                            <td>{{$project->address}}</td>
                                                            <td>{{$project->hour_cost}}</td>
                                                            <td>{{$project->manager->name ?? ''}}</td>
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
                                        <label for="name" class="form-control-label">שם </label>
                                        <input type="text" class="form-control" id="name" name="name"
                                               value="{{$contact->name}}" required>
                                    </div>
                                </div>

                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="phone" class="form-control-label">מספר הטלפון</label>
                                        <input type="text" class="form-control" id="phone" name="phone"
                                               value="{{$contact->phone}}" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="job_title" class="form-control-label">המשרה </label>
                                        <input type="text" class="form-control" id="job_title" name="job_title"
                                               value="{{$contact->job_title}}" required>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">ביטול</button>
                            <button type="submit" class="btn btn-primary">הוספה</button>
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
                                    <label for="name" class="form-control-label">שם </label>
                                    <input type="text" class="form-control" id="name" name="name"
                                           value="{{old('name')}}" required>
                                </div>
                            </div>

                            <div class="col-12">
                                <div class="form-group">
                                    <label for="phone" class="form-control-label">מספר הטלפון</label>
                                    <input type="text" class="form-control" id="phone" name="phone"
                                           value="{{old('phone')}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="form-group">
                                    <label for="job_title" class="form-control-label">המשרה </label>
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
