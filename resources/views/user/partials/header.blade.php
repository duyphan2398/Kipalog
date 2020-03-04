<?php
use Illuminate\Http\Request;
?>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-4">
    <div class="container">
        <div class=" float-left">
            <ul class="list-inline">
                <li class="list-inline-item">
                    <a href="{{url('/')}}" class="navbar-brand"><h3>Kipalog</h3></a>
                </li>
                @yield('searchForm')
            </ul>
        </div>
        <div class="float-right mt-1" >
            <ul class="list-inline">
                @guest
                    <li class="list-inline-item">
                        <a href="{{route('login')}}"><button class="btn btn-outline-success">Login</button></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{ url('register') }}"><button class="btn btn-outline-success">Register</button></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{url('resetpassword')}}"><button class="btn btn-outline-success">Forgot Password</button></a>
                    </li>
                @else

                    <li class="list-inline-item">
                        <a href="{{url('newpost')}}"><button class="btn">Viết bài</button></a>
                    </li>
                    <li class="list-inline-item">
                        <a href="{{url('myPosts')}}"><button class="btn">Kho log</button></a>
                    </li>
                    <li class="list-inline-item">
                        <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="Avartar"
                             style="vertical-align: middle;width: 50px;height: 50px;border-radius: 50%;border: 1px solid aquamarine">
                    </li>
                    <li class="list-inline-item">
                        <div class="dropdown">
                            <button class="btn btn-default dropdown-toggle" type="button" data-toggle="dropdown">{{\Illuminate\Support\Facades\Auth::user()->name}}
                                <span class="caret"></span></button>
                            <ul class="dropdown-menu">
                                <li><a href="{{url('myPage/'.\Illuminate\Support\Facades\Auth::id())}}">Trang ca nhan</a></li>
                                <li><a href="{{url('setting')}}">Cai dat</a></li>
                                <li><a href="{{url('logout')}}">Dang xuat</a></li>
                            </ul>
                        </div>
                    </li>
                @endguest
            </ul>
        </div>
    </div>
</nav>
