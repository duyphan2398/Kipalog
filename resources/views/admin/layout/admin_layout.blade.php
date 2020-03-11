<!DOCTYPE html>
<html>
<head>
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>
        @yield('title')
    </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    {{--Axios--}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--CSS--}}
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
    {{--Toastr--}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{-----------}}
    @yield("script-link")
    <style>
        a {
            text-decoration: none !important;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark ">
        <div class="container">
            <div class=" float-left">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="{{url('admin/dashboard')}}" class="navbar-brand"><h3>Kipalog</h3></a>
                    </li>
                </ul>
            </div>

            @if(\Illuminate\Support\Facades\Auth::guard('admin')->check())
            <div class="float-right mt-1">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">
                                <span class="caret">
                                    {{\Illuminate\Support\Facades\Auth::guard('admin')->user()->name}}
                                </span>
                            </button>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('admin/logout')}}">Logout</a></li>
                            </ul>
                        </div>
                    </li>
                </ul>
            </div>
            @endif
        </div>
    </nav>



    <div class="container-fluid w-100" style="margin-bottom: 50px">
        <div class="row">
                @if(action('Admin\LoginController@index') != Request::url())
                    @include('admin.partials.sidebar')
                @endif
                @yield('content')
        </div>
    </div>




    {{--Noice--}}
    <script>
        toastr.options = {
            "closeButton": true,
            "debug": false,
            "newestOnTop": false,
            "progressBar": true,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        }
        $(document).ready(function () {
            let flashSuccess = "{{session()->has('success')}}";
            let flashError = "{{session()->has('error')}}";
            if (flashSuccess) {
                toastr.success("{{session('success')}}");
            }
            if (flashError) {
                toastr.error("{{session('error')}}");
            }
        });
    </script>
    {{--Footer--}}

</body>
</html>
