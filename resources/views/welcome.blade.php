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
            <h4 class="text-center">Welcome to my Kipalog</h4>
        </div>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-9">
                <p>
                    <b>Debugging is twice as hard as writing the code in the first place.
                        Therefore, if you write the code as cleverly as possible, you are, by definition, not smart enough to debug it.
                    </b>
                    — Brian W. Kernighan
                </p>
                <button class="btn btn-dark" id="newPosts">
                    Bài viết mới
                </button>
                <button class="btn btn-dark" id="goodPosts">
                    Bài viết hay
                </button>
                <hr>
                <div id="tabContent" class="container-fluid">
                    {{-------------------------------------------------}}
                    <div id="listContent">
                    </div>
                    {{-----------------------------------------------}}
                    <div class="text-center mb-2"  id="ajax-loader" style="display: none">
                        <img src="/images/ajax-loader.gif" alt="loading...">
                    </div>
                    <div id="buttonMoreGoodPosts" class="text-center" style="display: none">
                        <button id= "moreGoodPosts"class="btn btn-primary w-75">
                            Xem thêm
                        </button>
                    </div>
                    <div id="buttonMoreNewPosts" class="text-center" style="display: block">
                        <button id= "moreNewPosts"class="btn btn-primary w-75">
                            Xem thêm
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{----------------------------------------------}}
                @include("user.partials.popularTags")
                {{-------------------------------------}}
            </div>
        </div>
    </div>
@endsection
