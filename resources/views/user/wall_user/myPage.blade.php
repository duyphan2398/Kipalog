@extends('user.layouts.layout')
@section('script-link')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-7"style="height: 500px">
                <div class="container text-center">
                    <div class="">
                        <img  style="width:150px; height: 150px; border-radius: 50%" src="{{asset($posts->first()->user->avatar)}}" alt="">
                    </div>
                    <div class=" mt-1">
                        <ul style="display: inline; font-size: 30px">
                            <li style="display: inline" >
                                <div>
                                   <h4>Tổng lượt bình luận</h4>
                                    20
                                </div>
                            </li>
                            |
                            <li style="display: inline">
                                <div>
                                   <h4>Tổng lượt like</h4>
                                    20
                                </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-5 text-center" style=" height: 500px">
                <h1 style="margin-top: 250px; font-size: 50px  ">
                    20 Bài viết
                </h1>
            </div>
        </div>
    </div>

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
                        By <a href="{{url("myPage/".$post->user->id)}}">{{$post->user->name}}</a> vào lúc {{$post->created_at}}
                    </div>
                    <div class="row mt-2 ml-1 mb-2">
                        <a  id="numCmt" href=" {{url("viewpost/{$post->id}")}}">{{count($post->comments) }}</a> Bình Luận
                        <||>
                        <a id="numLike" href="{{url("viewpost/{$post->id}")}}">{{count($post->likes) }} </a> Lượt thích
                    </div>
                </div>
            </div>
            <hr>
        @endforeach
    </div>





@endsection
