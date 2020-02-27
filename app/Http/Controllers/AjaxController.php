<?php

namespace App\Http\Controllers;
use App\Comment;
use App\Events\CommentRealtime;
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
             event(new CommentRealtime($comment, $comment->user));
             return response()->json([
                 'status' => 'success',
                 'comment' => $comment,
                 'user' => $comment->user
             ],201);
         }
         else{
             return response()->json([
                 'status' => 'fail'
             ],400);
         }
    }

    public function getComments(Post $post,Request $request){
        $comments = $post->comments()->orderByDesc('created_at')->paginate(5);
        $users = [];
        foreach ($comments as $comment){
            $users[$comment->id] = $comment->user;
        }
        return response()->json([
            'comments' => $comments,
            'users' => $users
        ],200);
    }

    public function getPostTag(Tag $tag){
        $posts = $tag->posts()->orderByDesc('created_at')->paginate(3);
        $users = [];
        $tags = [];
        foreach ($posts as $post) {
            $users[$post->id] = $post->user;
            $tags[$post->id] = $post->tags;
        }
        return response()->json([
            'posts' => $posts,
            'users' => $users,
            'tags' => $tags
        ],200);
    }

    public function getTagsNoiBat(){
        $tags = Tag::all();
        $tagsResult= $tags->sortByDesc(function ($tag) {
            return ($tag->posts()->count());
        })->take(4)->toArray();
        $result = array_values( $tagsResult);
        return  response()->json([
            'tags' => $result
        ],200);
    }
}
