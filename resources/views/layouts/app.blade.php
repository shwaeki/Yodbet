<!doctype html>
{{--<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">--}}
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title> {{config('app.name') }}</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Cairo:wght@200;300;400;500;600;700;800;900;1000&display=swap"
          rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Heebo:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">


    <link rel="stylesheet" href="{{asset('assets/fonts/stylesheet.css')}}">
    <!-- Icons -->
    <link rel="stylesheet" href="{{asset('assets/vendor/nucleo/css/nucleo.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/vendor/@fortawesome/fontawesome-free/css/all.min.css')}}"
          type="text/css">
    <!-- Page plugins -->
    <link rel="stylesheet" href="{{asset('assets/vendor/fullcalendar/dist/fullcalendar.min.css')}}">
    <link rel="stylesheet" href="{{asset('assets/vendor/sweetalert2/dist/sweetalert2.min.css')}}">

    <link rel="stylesheet" href="{{asset('assets/css/bootstrap-select.min.css')}}" type="text/css">
    <link rel="stylesheet" href="{{asset('assets/css/jquery-confirm.min.css')}}" type="text/css">
    {{--    <link rel="stylesheet" href="{{asset('assets/css/app.css')}}" type="text/css">--}}
    <link rel="stylesheet" href="{{asset('assets/css/app-rtl.css')}}" type="text/css">


    @livewireStyles

    @stack('styles')

</head>

<body>

{{--@include('backend.includes.navbar')--}}
<div class="main-content" id="panel">
    @include('backend.includes.header')
    @include('backend.includes.page-header')
    <div class="container-fluid mt--6">
        @yield('content')
    </div>
</div>
<script src="{{asset('assets/vendor/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('assets/vendor/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
<script src="{{asset('assets/vendor/js-cookie/js.cookie.js')}}"></script>
<script src="{{asset('assets/vendor/jquery.scrollbar/jquery.scrollbar.min.js')}}"></script>
<script src="{{asset('assets/vendor/jquery-scroll-lock/dist/jquery-scrollLock.min.js')}}"></script>

<script src="{{asset('assets/js/bootstrap-select.min.js')}}"></script>
<script src="{{asset('assets/js/jquery-confirm.min.js')}}"></script>
<script src="{{asset('assets/js/dashboard.js')}}"></script>
<script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>

@livewireScripts
@stack('scripts')


<form action="" method="POST" id="delete-form">
    <input name="_method" type="hidden" value="DELETE">
    <input name="_token" type="hidden" value="cKYYZgdyCJAP4Ahp5p11iElDc5Yf3OGL3QrmnVE2">
</form>

<script>

    function getFormData($form){
        var unindexed_array = $form.serializeArray();
        var indexed_array = {};

        $.map(unindexed_array, function(n, i){
            indexed_array[n['name']] = n['value'];
        });

        return indexed_array;
    }

    $(document).ready(function () {
        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });



        $(document).on("input", ".only-number", function() {
            this.value = this.value.replace(/\D/g,'');
        });

        $('.delete').on('click', function (e) {
            e.preventDefault();
            $("#delete-form").attr('action', $(this).attr('href'));

            jQuery.confirm({
                theme: 'material',
                icon: 'fas fa-wind-warning',
                backgroundDismiss: true,
                closeIcon: true,
                title: '!האם אתה בטוח',
                content: 'אתה לא יכול לבטל את הפעולה הזו.!',
                type: 'red',
                rtl: true,
                typeAnimated: true,
                buttons: {
                    confirm: {
                        text: 'בטוח',
                        btnClass: 'btn-red',
                        action: function () {
                            $("#delete-form").submit();
                        }
                    },
                    cancel: {
                        text: 'ביטול',
                    }
                }
            });
        })
        $('input[required],select[required],textarea[required]').each(function () {
            $($(this).parent()).find('label').addClass('required')
        });
    })
</script>

</body>
</html>
