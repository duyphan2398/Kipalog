@extends('user.layouts.layout')

@section('script-link')
    <script>
        var user_id = "{{$authUser->id}}";
    </script>
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script  type="text/javascript" src="{{asset("js/comment.js")}}"></script>
@endsection

@section('content')
    <style>
        .col{
            padding: 0;
        }
    </style>
    <div class="container">
        <div class="row">
            <div class="col-9">
                <div class="container-fluid">
                    <div class="row mb-2" style="overflow: auto">
                        <div class="col" style="word-wrap: break-word;">
                            <h2><strong>{{$post->title}}</strong></h2>
                        </div>

                    </div>
                    <div class="row">
                        @foreach($post->tags as $tag)
                            <button class="btn btn-dark mr-2">
                                {{$tag->name}}
                            </button>
                        @endforeach

                    </div>
                    <div class="row mt-2">
                        <p>*By <a href=""> {{ $post->user->name}}</a> ( {{$post->updated_at}} )</p>
                    </div>
                    <div class="row mt-2">
                        <div class="col" style="word-wrap: break-word;">
                            {{$post->content}}
                        </div>
                    </div>
                    <div class="row mt-2">
                        <button class="btn-outline-info btn" style="display: block">Like ! </button>
                        <button class="btn-outline-warning btn" style="display:none;">Unlike !</button>
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="container-fluid">
                            <div style="background-color: #0AA5DF;" class="row mb-4">
                                <h4 class="m-2">Bình Luận</h4>
                            </div>
                            @if(\Illuminate\Support\Facades\Auth::check())
                            <div class="row">
                                <ul class="list-inline">
                                    <li class="list-inline-item">
                                        <img src="{{asset($post->user->avatar)}}" alt="avatar" style="height: 50px;  border-radius: 50%;width: 50px">
                                    </li>
                                    <li class=" list-inline-item" >
                                        <form  id="formComment" class="form-inline">
                                            @csrf
                                            <textarea  cols="30" rows="5" style="width: 600px" placeholder="Enter your cmt " class="form-control mr-3"  type="text" name="comment" id="comment"> </textarea>
                                            <button id="submitFormComment" class="form-control btn btn-success" type="submit"> Gửi </button>
                                        </form>
                                    </li>
                                </ul>
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row" id="listComments">
                        {{--Cmt----------------------------------------------}}
                        {{--cmt----------------------------------------------}}
                    </div>

                    <div id="loadComment" class="text-center">
                        <img id="loadImage" style="display: none" src="{{asset('images/ajax-loader.gif')}}" alt="Loanding...">
                        <button id="loadButton" style="display: none"class="btn btn-dark w-100">
                            Xem thêm
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{----------------------------------------------}}
                @include("user.partials.chuDeNoiBat",['post'=>$post])
                {{-------------------------------------}}
            </div>
        </div>
    </div>

@endsection
