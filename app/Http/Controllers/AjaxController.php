<?php

namespace App\Http\Controllers;
use App\Models\Like;
use App\Models\Comment;
use App\Events\CommentRealtime;
use App\Http\Requests\NewCommentRequest;
use App\Models\Post;
use App\Models\Tag;
use App\Models\User;
use  Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AjaxController extends Controller
{
    public function getAllTags(){
        $tags = Tag::all();
        return response()->json($tags);
    }

    public function createComment(NewCommentRequest $request){
         $comment = new  Comment();
         $comment->fill($request->all());
         $comment->setUserIdAttribute(Auth::id());
         if ($comment->save()){
             event(new CommentRealtime($comment, $comment->user));
             return response()->json([
                 'status' => 'success',
                 'comment' => $comment,
                 'user' => Auth::user()
             ],201);
         }
         else{
             return response()->json([
                 'status' => 'fail'
             ],400);
         }
    }

    public function getCommentsByPost(Post $post,Request $request){
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

    public function getPostsByTag(Tag $tag){
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

    public function getPopularTags(){
        $tags = Tag::all();
        $tagsResult= $tags->sortByDesc(function ($tag) {
            return ($tag->posts()->count());
        })->take(4)->toArray();
        $result = array_values( $tagsResult);
        return  response()->json([
            'tags' => $result
        ],200);
    }

    public function createLike(Post $post, Request $request){
        $user = User::find($request->user_id);
        if ( $row = $user->likedThisPost($post) ){
            if ($row->delete()){
                return response()->json([
                    'status' => 'success'
                ],200);
            }
        }
        else{
            $like = new Like();
            $like->setUserIdAttribute($user->id);
            $like->post_id = $post->id;
            if ($like->save()){
                return response()->json([
                    'status' => 'success'
                ],200);
            }
        }
        return response()->json([
            'status' => 'fail'
        ],404);
    }

    public function changeStatePost(Post $post){
        if ($post->user->id == Auth::id()){
            if ($post->state == 'Private'){
                $post->state = 'Public';
                if ($post->save()){
                    return response()->json([
                        'status' => 'success'
                    ],200);
                }
            }
            else {
                $post->state = 'Private';
                if ($post->save()){
                    return response()->json([
                        'status' => 'success'
                    ],200);
                }
            }
        }
        return response()->json([
            'status' => 'fail'
        ],404);
    }

    public function deletePost(Post $post)
    {
        if (Auth::id() == $post->user->id){
            if ($post->delete()) {
                return response()->json([
                    'status' => 'success'
                ], 200);
            }
        }
        return response()->json([
            'status' => 'fail'
        ], 404);
    }
}
