<?php
use Illuminate\Support\Facades\Auth;
?>
<!DOCTYPE html>
<html>
<head>
    <title>
        @yield('title')
    </title>
    <!-- Bootstrap -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
    <!-- Jquery -->
    <script type="text/javascript" src="/js/jquery-3.4.1.min.js"></script>
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
        <div class="container">
            <div class=" float-left">
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <a href="" class="navbar-brand"><h3>Kipalog</h3></a>
                    </li>
                    @if(\Illuminate\Support\Facades\Auth::check())
                    <li class="list-inline-item">
                        <form class="form-inline">
                            <input class="form-control " type="search" placeholder="Search" aria-label="Search">
                        </form>
                    </li>
                    @endif
                </ul>
            </div>
            <div class="float-right mt-1">
                <ul class="list-inline">
                    @guest
                    <li class="list-inline-item">
                        <button class="btn"><a href="/login">Login</a></button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn"><a href="/register">Register</a></button>
                    </li>
                    @else

                    <li class="list-inline-item">
                        <button class="btn"><a href="#">Viết bài</a></button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn"><a href="#">Kho log</a></button>
                    </li>
                    <li class="list-inline-item">
                        <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" alt="Avartar" style="vertical-align: middle;width: 50px;height: 50px;border-radius: 50%;">
                    </li>
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{\Illuminate\Support\Facades\Auth::user()->name}}
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="#">Trang ca nhan</a></li>
                                <li><a href="#">Cai dat</a></li>
                                <li><a href="/logout">Dang xuat</a></li>
                            </ul>
                        </div>
                    </li>
                    @endguest
                </ul>
            </div>
        </div>
    </nav>

    @yield('content')
    @if(count($errors) >0)
        <div class="container">
            <div class="row">
                <div class="row w-100">
                    <div class="alert alert-danger alert-dismissible fade show mb-4 mt-3 w-50" role="alert">
                        @foreach($errors->all() as $error)
                            <strong>{{$error}}</strong><br>
                        @endforeach
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                </div>
            </div>
        </div>

    @endif
    <hr>
    <div>
        <h1 class="text-center">THIS IS FOOTER</h1>
    </div>


    <script !src="">
        var status = "{{session()->has('status')}}";
        var msg = "{{session('status')}}";
        if ( status) {
            alert(msg);
        }
    </script>
</body>
</html>
