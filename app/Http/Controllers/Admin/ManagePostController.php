<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ManagePostController extends Controller {
    public function index(){
        return view('admin.workspace.managePost');
    }

    public  function show(){
        $posts = Post::orderBy('created_at','desc')->paginate(8);
        $tags = [];
        foreach ($posts as $post) {
            $tags[$post->id] = $post->tags;
            $post->user = User::withTrashed()->whereId($post->user_id)->first();
        }
        return response()->json([
            'status' => 'success',
            'posts' =>$posts,
        ],200);
    }


    /*Delete row*/
    public function delete(Request $request){
        $post = Post::find($request->post_id);
        if ($post->delete()){
            return response()->json([
                'status' => 'success',
            ],200);
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }
}
