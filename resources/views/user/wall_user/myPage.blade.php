@extends('user.layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-7"style="height: 350px">
                <div class="container text-center">
                    <div class="">
                        <img  style="width:150px; height: 150px; border-radius: 50%" src="{{asset($posts->first()->user->avatar)}}" alt="">
                    </div>
                    <div>
                        <h1>{{$posts->first()->user->name}}</h1>
                    </div>
                    <div class=" mt-1">
                        <ul class="list-inline">
                            <li class="list-inline-item"><h4>{{$countCmt}} Be Commented</h4></li>
                            <li class="list-inline-item"><h1>|</h1></li>
                            <li class="list-inline-item"><h4>{{$countLike}} Be Liked</h4></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-5 text-center" style=" height: 200px">
                <h1 style="margin-top: 100px; font-size: 50px  ">
                    {{count($posts)}} Posts
                </h1>
            </div>
        </div>
    </div>
    <hr>
    <div class="container">
        @foreach( $posts as $post)
            <div class="row" id="post{{$post->id}}" style="padding: 20px; border-radius:10% ;border: 1px solid cornflowerblue">
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
                        By <a href="{{url("myPage/".$post->user->id)}}">{{$post->user->name}}</a> when {{$post->created_at}}
                    </div>
                    <div class="row mt-2 ml-1 mb-2">
                        <a  id="numCmt" href=" {{url("viewpost/{$post->id}")}}">{{count($post->comments) }}</a> Comments
                        <||>
                        <a id="numLike" href="{{url("viewpost/{$post->id}")}}">{{count($post->likes) }} </a> Likes
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>
@endsection
