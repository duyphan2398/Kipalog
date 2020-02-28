<html>
<head>
    <title>
        @yield('title')
    </title>
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script type="text/javascript" src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <!-- Js-->
    <script type="text/javascript" src="{{asset('js/main.js')}}"></script>
    {{--Axios--}}
    <script src="https://unpkg.com/axios/dist/axios.min.js"></script>
    {{--Toastr--}}
    <link href="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/css/toastr.min.css" rel="stylesheet">
    <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>
    {{--Other--}}
    @yield('script-link')
</head>
<body>
    @include('user.partials.header')
    @yield('content')
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
        var flashSuccess = "{{session()->has('success')}}";
        var flashError = "{{session()->has('error')}}";
        if (flashSuccess){
            toastr.success("{{session('success')}}");
        }
        if (flashError){
            toastr.error("{{session('error')}}");
        }
    </script>
    @include('user.partials.footer')
</body>
</html>





















{{--

@extends('user.layouts.layout')

@section('script-link')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    <script src="https://cdn.ckeditor.com/4.13.1/standard/ckeditor.js" ></script>
    <script !src="{{asset('js/newPost.js')}}"></script>
@endsection

@section('title')
    New Post
@endsection


@section('content')

    <form class="m-5 " id="newPostForm" >
        @csrf
        <div class="form-group">
            <label for="title">Enter Title: </label>
            <input type="text" name="title" id="title" class="form-control" required/>
        </div>
        <div class="form-group">
            <label for="tags">Enter Tags: </label>
            <input type="text" name="tags" id="tags" class="form-control" required/>
        </div>
        <div class="form-group">
            <label for="content">Enter Content: </label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10" required></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" id="submitNewPost" class="btn btn-info" value="Create New Post" />
        </div>
    </form>
    <script>
        CKEDITOR.replace( 'content' );
    </script>
@endsection

--}}
