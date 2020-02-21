<?php
namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use App\Post;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller {

    public function index(){
        $posts = Post::orderBy('created_at','desc')->get();
        return view('welcome')->with('posts', $posts);
    }

    /*Show kho bài viết cá nhân*/
    public function myPost(){
        $posts = Post::whereUser_id(Auth::user()->id)->orderBy('created_at','desc')->get();
        return view('user.user.userPost')->with('posts', $posts);
    }
}
