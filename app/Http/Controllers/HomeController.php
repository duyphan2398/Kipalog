<?php
namespace App\Http\Controllers;
use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
class HomeController extends Controller {
    public function index(){
        return view('welcome');
    }

    /*Return the personal posts*/
    public function myPosts(){
        if (Auth::check()){
            $posts = Post::whereUser_id(Auth::id())->orderBy('created_at','desc')->get();
            return view('user.wall_user.myPost')->with('posts', $posts);
        }
    }

    /*Return the new posts when click the button "BÀI VIẾT MỚI" (The Defaul Load in Homepage)*/
    public function getNewPosts(){
        $posts = Post::with('user')->whereHas('user', function ($user){
            $user->where('deleted_at',null);
        })->where('state', '<>', 'Private')->orderBy('created_at','desc')->paginate(5);
        $user = [];
        $tags = [];
        $comments = [];
        $likes =[];
        foreach ($posts as $post){
            $user[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
            $comments[$post->id] = $post->comments;
            $likes[$post->id] = $post->likes;
        }
        if ($posts) {
            return response()->json([
                'post' => $posts,
                'user' => $user,
                'tags' => $tags,
                'comments' =>$comments,
                'likes' => $likes,
                'status' => 'success'
            ],200);
        }
        else {
            return response()->json([
                'status' => 'fail'
            ],404);
        }
    }

    /*Return the good posts when click the button "BÀI VIẾT HAY" */
    public function getGoodPosts(){
        $posts = Post::with('user')->whereHas('user', function ($user){
            $user->where('deleted_at',null);
        })->where('state', '<>', 'Private')->withCount('comments')->orderBy('comments_count','desc')->paginate(5);
        $user = [];
        $tags = [];
        $comments = [];
        $likes = [];
        foreach ($posts as $post){
            $user[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
            $comments[$post->id] = $post->comments;
            $likes[$post->id] = $post->likes;

        }
        if ($posts) {
            return response()->json([
                'post' => $posts,
                'user' => $user,
                'tags' => $tags,
                'comments' =>$comments,
                'likes' => $likes,
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
            $searchPosts = Post::query()->whereLike(['title','content'], $request->searchInput)->with('user')->whereHas('user', function ($user){
                $user->where('deleted_at',null);
            })->where('state', '<>', 'Private')->get();
            $comments = [];
            $users = [];
            $tags =[];
            $likes = [];
            foreach ($searchPosts as $post){
                $users[$post->id] = $post->user;
                $tags[$post->id] = $post->tags;
                $comments[$post->id] = $post->comments;
                $likes[$post->id] = $post->likes;
            }
            if (count($searchPosts)){
                return response()->json([
                    'searchPosts'=>$searchPosts,
                    'tags'=>$tags,
                    'user' => $users,
                    'likes' => $likes,
                    'comments' => $comments,
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
