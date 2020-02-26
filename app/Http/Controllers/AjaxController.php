<?php

namespace App\Http\Controllers;

use App\Comment;
use App\Http\Requests\NewCommentRequest;
use App\Http\Requests\NewPostRequest;
use App\Post;
use App\Tag;
use  Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class AjaxController extends Controller
{
    public function getTags(){
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function postTags(NewPostRequest $request){
        $post = new Post();
        $post->fill($request->all());
        $post->setUserIdAttribute(Auth::id());
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
                'status' => 'success'
            ],201);
        }
        return response()->json([
            'status' => 'fails'
        ],404);
    }

    public function newComment(NewCommentRequest $request){
         $comment = new  Comment();
         $comment->fill($request->all());
         $comment->setUserIdAttribute(Auth::id());
         if ($comment->save()){
             return response()->json([
                 'status' => 'success'
             ],201);
         }
         else{
             return response()->json([
                 'status' => 'fail'
             ],400);
         }
    }

    public function getComments(Request $request){
        $post = Post::find($request->post_id);
        $comments = $post->comments;
        $comments = $comments->sortByDesc('created_at');
        return response()->json([
            'comments' => $comments
        ],200);
    }



}
