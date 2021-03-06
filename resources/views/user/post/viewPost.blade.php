@extends('user.layouts.layout')

@section('script-link')
    <script>
        var user_id = "{{$authUser->id}}";
    </script>
    <script src="https://js.pusher.com/5.1/pusher.min.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.12.0/jquery.validate.js"></script>
    <script type="text/javascript" src="http://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.12.0/additional-methods.js"></script>
    <script  type="text/javascript" src="{{asset("js/commentAndLike.js")}}"></script>
    <style>
        .error{
            color: red;
            margin-top: 2px;
            justify-content: left !important;
        }

        .like{
            transition: transform 1s;
            margin: 3px;
        }
        .like:hover{
            transform: scale(1.4);
        }
        .like:active{
            transform: scale(1);
        }
    </style>
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
                                <a href="{{url('tag/'.$tag->id)}}">{{$tag->name}}</a>
                            </button>
                        @endforeach

                    </div>
                    <div class="row mt-2">
                        <div>
                            <p>*By <a href="{{url('myPage/'.$post->user->id)}}">{{ $post->user->name}}</a> when {{$post->created_at}} </p>
                        </div>
                    </div>

                    <div class="row mt-2">
                        <div class="col" style="word-wrap: break-word;">
                            {{$post->content}}
                        </div>
                    </div>
                    <div class="row mt-2 " >
                        @if(\Illuminate\Support\Facades\Auth::check())
                            @if($authUser->likedThisPost($post))
                                <button id="liked" class="like btn-outline-info btn" style="display: inline-block"><img  style="width: 20px; height: 20px"  src="{{asset('images/like.png')}}" alt=""></button>
                                <button id="like" class="like btn-outline-info btn" style="display: none"><img style="width: 20px; height: 20px" src="{{asset('images/nomalLike.png')}}" alt=""></button>
                            @else
                                <button id="liked" class="like btn-outline-info btn" style="display: none"><img  style="width: 20px; height: 20px"  src="{{asset('images/like.png')}}" alt=""></button>
                                <button id="like" class="like btn-outline-info btn" style="display: inline-block"><img style="width: 20px; height: 20px" src="{{asset('images/nomalLike.png')}}" alt=""></button>
                            @endif
                        @endif

                    </div>
                    <div class="row mt-3">
                        <a  id="numCmt" href=" {{url("viewpost/{$post->id}")}}">{{count($post->comments)." "}}</a> Comments
                        <||>
                        <a id="numLike" href="{{url("viewpost/{$post->id}")}}">{{count($post->likes)." "}} </a> Likes
                    </div>
                    <div class="row mt-3 mb-2">
                        <div class="container-fluid">
                            <div style="background-color: #0AA5DF;" class="row mb-4">
                                <h4 class="m-2">Comment</h4>
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
                                            <div>
                                                 <textarea  cols="30" rows="5" style="width: 600px" placeholder="Enter your cmt " class="form-control mr-3"  type="text" name="comment" id="comment">   </textarea>
                                                  <label for="comment" class="error"></label>
                                            </div>
                                            <button id="submitFormComment" class="form-control btn btn-success" type="submit"> Send </button>
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
                            See more
                        </button>
                    </div>
                </div>
            </div>
            <div class="col-3">
                {{----------------------------------------------}}
                @include("user.partials.popularTags",['post'=>$post])
                {{-------------------------------------}}
            </div>
        </div>
    </div>

@endsection
