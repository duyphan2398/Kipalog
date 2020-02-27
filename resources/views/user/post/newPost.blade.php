@extends('user.layouts.layout')

@section('script-link')
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/css/bootstrap-tokenfield.min.css">
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tokenfield/0.12.0/bootstrap-tokenfield.js"></script>
    <script src="http://ajax.aspnetcdn.com/ajax/jquery.validate/1.11.1/jquery.validate.min.js"></script>
    <script  type="text/javascript" src="{{asset("js/newPost.js")}}"></script>
@endsection

@section('title')
    New Post
@endsection


@section('content')

    <form class="m-5" id="newPostForm" >
        @csrf
        <div class="form-group">
            <label for="title">Enter Title: </label>
            <input type="text" name="title" id="title" class="form-control" />
        </div>
        <div class="form-group">
            <label for="tags">Enter your tags</label>
            <input type="text" name="tags" id="tags" class="form-control" />
        </div>

        <div class="form-group">
            <label for="content">Enter your tags</label>
            <textarea class="form-control" name="content" id="content" cols="30" rows="10"></textarea>
        </div>

        <div class="form-group">
            <input type="submit" name="submit" id="submit" class="btn btn-info" value="Submit" />
        </div>
    </form>

@endsection