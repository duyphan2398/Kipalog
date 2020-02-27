<?php
namespace App\Http\Controllers;
use App\Post;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller {

    public function index(){
        return view('welcome');
    }

    /*Show kho bài viết cá nhân*/
    public function myPost(){
        $posts = Post::whereUser_id(Auth::id())->orderBy('created_at','desc')->get();
        return view('user.wall_user.userPost')->with('posts', $posts);
    }

    /*Trả về các bài viết mới khi click vào button bai viết mới (Defaul khi load trang)*/
    public function baiVietMoi(){
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        $user = [];
        $tags = [];
        foreach ($posts as $post){
            $user[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
        }
        if ($posts) {
            return response()->json([
                'post' => $posts,
                'user' => $user,
                'tags' => $tags,
                'status' => 'success'
            ],200);
        }
        else {
            return response()->json([
                'status' => 'fail'
            ],404);
        }
    }


    /*Show bài viết hay*/
    public function baiVietHay(){
        $posts = Post::orderBy('created_at')->paginate(3);
        $user = [];
        $tags = [];
        foreach ($posts as $post){
            $user[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
        }
        if ($posts) {
            return response()->json([
                'post' => $posts,
                'user' => $user,
                'tags' => $tags,
                'status' => 'success'
            ],200);
        }
        else {
            return response()->json([
                'status' => 'fail'
            ],404);
        }
    }


    public function search(Request $request){
        if ($request->searchInput) {
            $searchPosts = Post::query()->whereLike(['title','content'], $request->searchInput)->get();
            foreach ($searchPosts as $post){
                $user[$post->id] = $post->user;
                $tags[$post->id] = $post->tags;
            }
            if ($searchPosts){
                return response()->json([
                    'searchPosts'=>$searchPosts,
                    'tags'=>$tags,
                    'user' => $user,
                    'status' => 'success'

                ],200);
            }
            else {
                return response()->json([
                    'status' => 'fail'
                ],404);
            }

        }
    }
}
