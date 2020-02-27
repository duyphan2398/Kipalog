@extends('user.layouts.layout')

@section('searchForm')
    <li class="list-inline-item">
        <form id="searchForm" class="form-inline " style="width: 350px">
            @csrf
            <input id="searchInput" class="form-control w-100 " type="search" placeholder="Enter Search" aria-label="Search">
        </form>
    </li>
@endsection

@section('content')
    <div class="container w-100">
        <div class="row w-100">
            <h1>#{{$tag->name}}</h1>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div id="tabContent" class="container-fluid">
                    {{-------------------------------------------------}}
                    <div id="listContent">

                    </div>

                    {{-----------------------------------------------}}

                    <div class="text-center mb-2"  id="ajax-loader" style="display: none">
                        <img src="/images/ajax-loader.gif" alt="loading...">
                    </div>


                    <div id="buttonAddBaiVietHay" class="text-center" style="display: none">
                        <button id= "addBaiVietHay"class="btn btn-primary w-75">
                            Xem thêm
                        </button>
                    </div>

                    <div id="buttonAddBaiVietMoi" class="text-center" style="display: block">
                        <button id= "addBaiVietMoi"class="btn btn-primary w-75">
                            Xem thêm
                        </button>
                    </div>

                </div>
            </div>
            <div class="col-3">
                {{----------------------------------------------}}
                @if(\Illuminate\Support\Facades\Auth::user())
                    <div class="container-fluid">
                        <div class="row">
                            <div class="col-3">
                                <img src="{{\Illuminate\Support\Facades\Auth::user()->avatar}}" alt="" style="height: 50px;  border-radius: 50%;width: 50px">
                            </div>
                            <div class="col-8">
                                <h4>
                                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                                </h4>
                                <div>
                                    <a href="/myPosts">{{\Illuminate\Support\Facades\Auth::user()->posts->count()}}</a> Bai viet
                                </div>
                            </div>
                            <hr>
                        </div>

                        <div class="row mt-1">
                            <h4><i>Chủ đề nổi bật</i></h4>
                            <div>
                                <button class="btn-danger btn mb-1">
                                    PHP
                                </button>
                                <button class="btn-danger btn mb-1">
                                    Javascript
                                </button>
                                <button class="btn-danger btn mb-1">
                                    Ubuntu
                                </button>
                                <button class="btn-danger btn mb-1">
                                    Microsoft Office
                                </button>
                            </div>
                        </div>
                    </div>
                @endif
                {{-------------------------------------}}
            </div>
        </div>
    </div>

@endsection
