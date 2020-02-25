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
    {{--Other--}}
    @yield('script-link')
</head>
<body>
    @include('user.partials.header')
    @yield('content')
    @if( $errors->count() > 0)
        <div class="container">
            <div class="row">
                <div class="row w-100">
                    <div class="alert alert-danger alert-dismissible fade show mb-4 mt-3 w-50" role="alert">
                        @foreach($errors->messages() as $error)
                            <strong>{{$error[0]}}</strong><br>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif
    @include('user.partials.footer')
    <script !src="">
        var status = "{{session()->has('status')}}";
        var msg = "{{session('status')}}";
        if ( status) {
            alert(msg);
        }
    </script>
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
