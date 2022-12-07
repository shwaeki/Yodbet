@extends('layouts.app')


@push('title')
    דוח ריכוז
@endpush

@push('pg_btn')
    <a href="{{route('client.index')}}" class="btn btn-sm btn-neutral">חזרה </a>
@endpush


@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="card mb-5">
                <div class="card-body">

                    <h6 class="heading-small text-muted mb-4">דוח ריכוז</h6>
                    <div class="pl-lg-4">
                        <div class="row">


                            <div class="col-4">
                                <div class="form-group">
                                    <label for="date" class="form-control-label"> תאריך </label>
                                    <input type="month" class="form-control" id="date" name="date"
                                           value="{{request('month') }}" required>
                                </div>
                            </div>
                        </div>

                        @if(request('month') )
                            <div class="table-responsive">
                                <div>
                                    <table class="table align-items-center table-sm table-striped"
                                           id="AttendanceTable">
                                        <thead class="thead-light">
                                        <tr>
                                            <th>#</th>
                                            <th>עובד</th>
                                            <th>סך הכל שעות</th>
                                            <th>שעות רגילות</th>
                                            <th>שעות 125%</th>
                                            <th>שעות 150%</th>
                                            <th>שעות בונוס</th>
                                        </tr>
                                        </thead>
                                        <tbody>

                                        @foreach( $data as $d)
                                            <tr>
                                                <td>{{$d->id}}</td>
                                                <td>{{$d->name}}</td>
                                                <td>{{$d->attendances['sum']}}</td>
                                                <td>{{$d->attendances['hours']['hours_normal']}}</td>
                                                <td>{{$d->attendances['hours']['hours_125']}}</td>
                                                <td>{{$d->attendances['hours']['hours_150']}}</td>
                                                <td>{{$d->attendances['hours']['hours_bonus']}}</td>

                                            </tr>

                                        @endforeach


                                        </tbody>
                                    </table>

                                </div>
                            </div>
                        @endif

                    </div>

                </div>
            </div>
        </div>
    </div>

    <form id="monthFom">
        <input type="hidden" id="month" name="month" value="">
    </form>

@endsection



@push('scripts')

    <script>

        $('#date').on('change', function () {
            var date = $('#date').val();
            if (date) {
                $('#monthFom #month').val(date);
                $('#monthFom').submit();
            }
            if (this.value === "" || this.value == null) {
                $('#monthFom #month').val(null);
                $('#monthFom').submit();
            }
        });


    </script>

@endpush
