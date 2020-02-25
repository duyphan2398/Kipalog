<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PostController extends Controller
{
    public function index(){
        return view('user.post.newPost');
    }
    public function create(){
        dd("hello");
    }
}
