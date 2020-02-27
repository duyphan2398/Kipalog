@extends('user.layouts.layout')



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

                <hr class="">
                <div class="listContent">

                    <div class="container-fluid">

                        {{-----------------------------Content-----------------------------}}
                        @foreach( $posts as $post)
                            <div class="row">
                                <div class="col-1 ">
                                    <img src="{{asset($post->user->avatar)}}"  style="height: 50px;  border-radius: 50%;width: 50px">
                                </div>
                                <div class="col-11"  style="word-wrap: break-word;">
                                    <h3 class="p-2">
                                        <a href="/viewpost/{{$post->id}}">{{$post->title}}</a>
                                    </h3>
                                    <div class="tag mb-1">
                                        @foreach($post->tags as $tag)
                                            <button class="btn btn-success mr-2">
                                                <a href="/tag/{{$tag->id}}">
                                                    {{$tag->name}}
                                                </a>
                                            </button>
                                        @endforeach
                                    </div>
                                    <div class="content" style="overflow: hidden; height: 150px">
                                        {{$post->content}}
                                    </div>
                                    <div>
                                        By <a href="">{{$post->user->name}}</a>  vào 16 giay trước
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
