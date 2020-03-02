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
    public function myPost(){
        $posts = Post::whereUser_id(Auth::id())->orderBy('created_at','desc')->get();
        return view('user.wall_user.userPost')->with('posts', $posts);
    }

    /*Return the new posts when click the button "BÀI VIẾT MỚI" (The Defaul Load in Homepage)*/
    public function getNewPosts(){
        $posts = Post::orderBy('created_at','desc')->paginate(5);
        $user = [];
        $tags = [];
        $comments = [];
        foreach ($posts as $post){
            $user[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
            $comments[$post->id] = $post->comments;
        }
        if ($posts) {
            return response()->json([
                'post' => $posts,
                'user' => $user,
                'tags' => $tags,
                'comments' =>$comments,
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
        $posts = Post::orderBy('created_at')->paginate(3);
        $user = [];
        $tags = [];
        $comments = [];
        foreach ($posts as $post){
            $user[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
            $comments[$post->id] = $post->comments;

        }
        if ($posts) {
            return response()->json([
                'post' => $posts,
                'user' => $user,
                'tags' => $tags,
                'comments' =>$comments,
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
            if (count($searchPosts)){
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
