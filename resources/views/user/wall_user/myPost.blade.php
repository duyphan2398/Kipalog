@extends('user.layouts.layout')
@section('script-link')
    <script  type="text/javascript" src="{{asset("js/myPosts.js")}}"></script>
@endsection


@section('content')
    <style>
        .state{
            transition: transform 1s;
            margin: 3px;
        }
        .state:hover{
            transform: scale(1.4);
        }
        .state:active{
            transform: scale(1);
        }
    </style>
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

                <hr class="">
                <div class="listContent">

                    <div class="container-fluid">

                        {{-----------------------------Content-----------------------------}}
                        @foreach( $posts as $post)
                            <div class="row" id="post{{$post->id}}">
                                <div class="col-1 ">
                                    <img src="{{asset($post->user->avatar)}}"  style="height: 50px;  border-radius: 50%;width: 50px">
                                </div>
                                <div class="col-11"  style="word-wrap: break-word;">
                                    <h3 class="p-2">
                                        <a href="{{url('viewpost/'.$post->id)}}">{{$post->title}}</a>
                                    </h3>
                                    <div class="tag mb-1">
                                        @foreach($post->tags as $tag)
                                            <button class="btn btn-success mr-2">
                                                <a href="{{url('tag/'.$tag->id)}}">
                                                    {{$tag->name}}
                                                </a>
                                            </button>
                                        @endforeach
                                    </div>
                                    <div class="content" style="overflow: hidden; height: 150px">
                                        {{$post->content}}
                                    </div>
                                    <div>
                                        By <a href="{{url("myPosts/".$post->user->id)}}">{{$post->user->name}}</a> vào lúc {{$post->created_at}}
                                    </div>
                                    <div class="row mt-2 ml-1 mb-2">
                                        <a  id="numCmt" href=" {{url("viewpost/{$post->id}")}}">{{count($post->comments) }}</a> Bình Luận
                                        <||>
                                        <a id="numLike" href="{{url("viewpost/{$post->id}")}}">{{count($post->likes) }} </a> Lượt thích
                                    </div>
                                    <div style="float: left">
                                        <button name="{{$post->id}}" class="deletePost btn btn-danger">
                                            Delete
                                        </button>
                                    </div>
                                    <div style="float: right">

                                        @if($post->state == "Private")
                                            <button name="{{$post->id}}" class="state statePrivate btn-outline-info btn" style="display: inline-block">
                                                <img  style="width: 20px; height: 20px"  src="{{asset('images/private.png')}}" alt="">
                                            </button>
                                            <button name="{{$post->id}}" class="state statePublic btn-outline-info btn" style="display: none">
                                                <img style="width: 20px; height: 20px" src="{{asset('images/public.png')}}" alt="">
                                            </button>
                                        @else
                                            <button name="{{$post->id}}" class=" statestatePrivate btn-outline-info btn" style="display: none">
                                                <img  style="width: 20px; height: 20px"  src="{{asset('images/private.png')}}" alt="">
                                            </button>
                                            <button name="{{$post->id}}" class=" state statePublic btn-outline-info btn" style="display: inline-block">
                                                <img style="width: 20px; height: 20px" src="{{asset('images/public.png')}}" alt="">
                                            </button>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <hr>
                        @endforeach
                        {{-----------------------------------------------}}
                    </div>
                </div>
            </div>
            <div class="col-3">
            </div>
        </div>
    </div>

@endsection
