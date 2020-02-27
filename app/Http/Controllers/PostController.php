<?php

namespace App\Http\Controllers;
use App\Tag;
use App\User;
use Illuminate\Support\Facades\Auth;
use App\Post;

class PostController extends Controller
{
    public function index(){
        return view('user.post.newPost');
    }

    public function viewPost(Post $post){
        $user = new User();
        if (Auth::check()){
            $user = Auth::user();
        }
        return view('user.post.viewPost')->with([
            'post'=>$post,
            'authUser' => $user
        ]);
    }

    public function viewTag(Tag $tag){
        $posts = $tag->posts->sortByDesc("created_at");
        return view('tag')->with([
            'posts' => $posts,
            'tag'  =>$tag
        ]);
    }


}
