<?php

namespace App\Http\Controllers;
use App\Http\Requests\NewPostRequest;
use App\Models\Tag;
use App\Models\User;
use Illuminate\Support\Carbon;
use App\Models\Post;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class PostController extends Controller
{

    public function index(){
        return view('user.post.newPost');
    }

    public function  create(NewPostRequest $request){
        $post = new Post();
        $post->fill($request->all());
        $post->setUserIdAttribute(Auth::id());
        $post->stripTags(["title","content"]);
        if ($post->save()){
            foreach ($request->arrayTags as $tag){
                $tagInTable = Tag::whereName($tag)->first();
                if ($tagInTable ){
                    DB::table('posts_tags')->insert([
                        'post_id'=>$post->id,
                        'tag_id' =>$tagInTable->id
                    ]);
                }
                else{
                    $newTag = new Tag();
                    $newTag->fill(['name' => $tag]);
                    $newTag->stripTags(['name']);
                    if ($newTag->save()){
                        DB::table('posts_tags')->insert([
                            'post_id'=>$post->id,
                            'tag_id' =>$newTag->id,
                            'created_at'=> Carbon::now(),
                            'updated_at' => Carbon::now()
                        ]);
                    }
                }
            }

            return response()->json([
                'status' => 'success',
            ],201);
        }

        return response()->json([
            'status' => 'fails',
        ],404);
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

    public function myPage(User $user){
        $posts = Post::where('user_id', $user->id)->get();
        return view('user.wall_user.myPage')->with('posts', $posts);
    }
}
