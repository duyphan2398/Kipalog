<style>
    .categorybtn {
        width: 250px;
    }
</style>
@if(\Illuminate\Support\Facades\Auth::check())
    <style>

        .categorybtn {
            width: 250px;
        }
    </style>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3">
                <img src="{{asset(\Illuminate\Support\Facades\Auth::user()->avatar)}}" alt="" style="height: 50px;  border-radius: 50%;width: 50px;border: 2px solid red">
            </div>
            <div class="col-8">
                <h4>
                    {{\Illuminate\Support\Facades\Auth::user()->name}}
                </h4>
                <div>
                    <a href="/myPosts">{{\Illuminate\Support\Facades\Auth::user()->posts->count()}}</a> Posts
                </div>
            </div>
            <hr>
        </div>
        <div class="row mt-3">
            <h4><i>Popular Tags</i></h4>
        </div>
        <div class="row mt-3">
            <div id="popularTag">

            </div>
        </div>
        <div class="row mt-4">
            <h4><i>Categories</i></h4>
        </div>
        <div class="row mt-2">

        </div>
    </div>
@else
    <div class="container-fluid">
        @if(isset($post))
        <div class="row">
            <div class="col-3">
                <img src="{{asset($post->user->avatar)}}" alt="" style="height: 50px;  border-radius: 50%;width: 50px">
            </div>
            <div class="col-8">
                <h4>
                    {{$post->user->name}}
                </h4>
                <div>
                    <a href="/myPosts">{{$post->user->posts->count()}}</a> Posts
                </div>
            </div>
            <hr>
        </div>
        @endif
        <div class="row mt-3">
            <h4><i>Popular Tags</i></h4>
        </div>
        <div class="row mt-3">
            <div id="popularTag">
            </div>
        </div>
        <div class="row mt-4">
            <h4><i>Categories</i></h4>
        </div>
        <div class="row mt-2">
            <ul class="list-group"  id="categories" >

            </ul>
        </div>
    </div>
@endif
