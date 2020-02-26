<?php

namespace App\Http\Controllers;

use App\Post;

class PostController extends Controller
{
    public function index(){
        return view('user.post.newPost');
    }
    public function viewPost(Post $post){
        return view('user.post.viewPost')->with(['post'=>$post]);
    }
}
