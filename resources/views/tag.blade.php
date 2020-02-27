@extends('user.layouts.layout')

@section('script-link')
    <script  type="text/javascript" src="{{asset("js/tag.js")}}"></script>
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
                    <div id="listContent">

                    </div>
                    <div class="text-center mb-2"  id="loading" style="display: none">
                        <img src="/images/ajax-loader.gif" alt="loading...">
                    </div>
                    <div id= "addMore" class="text-center" style="display: none">
                        <button class="btn btn-primary w-75">
                            Xem thêm
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                @if(\Illuminate\Support\Facades\Auth::check())
                    @include("user.partials.chuDeNoiBat")
                @endif
            </div>
        </div>
    </div>
@endsection
