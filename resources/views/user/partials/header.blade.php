<?php
use Illuminate\Http\Request;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <div class=" float-left">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="/" class="navbar-brand"><h3>Kipalog</h3></a>
                </li>
                @yield('searchForm')
            </ul>
        </div>
        <div class="float-right mt-1">
            <ul class="list-inline">
                @guest
                    <li class="list-inline-item">
                        <button class="btn"><a href="{{route('login')}}">Login</a></button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn"><a href="/register">Register</a></button>
                    </li>
                    <li>
                        <button class="btn"><a href="/resetpassword">Forgot Password</a></button>
                    </li>
                @else

                    <li class="list-inline-item">
                        <button class="btn"><a href="/newpost">Viết bài</a></button>
                    </li>
                    <li class="list-inline-item">
                        <button class="btn"><a href="myPosts">Kho log</a></button>
                    </li>
                    <li class="list-inline-item">
                        <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="Avartar" style="vertical-align: middle;width: 50px;height: 50px;border-radius: 50%;">
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
