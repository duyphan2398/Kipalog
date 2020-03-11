<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;

class ManageCategoryController extends Controller {
    public function index(){
        return view('admin.workspace.manageCategory');
    }

    public function  show(){
        $tags = Tag::orderBy('created_at','desc')->where('is_category','<>','1')->get();
        $categories = Tag::orderBy('created_at','desc')->where('is_category','=','1')->get();
        return response()->json([
            'status' => 'success',
            'tags' =>$tags,
            'categories' =>$categories
        ],200);
    }


    public function create(Request $request){
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->stripTags(['name']);
        $tag->is_category = 1;
        if (Tag::where('name', 'like', '%'.$tag->name.'%')->get()->count() > 0) {
            return response()->json([
                'status' => 'Existed !',
            ],404);
        }
        if ($tag->save()){
            return response()->json([
                'status' => 'success',
                'category' =>$tag,
            ],200);
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }


    public function update(Request $request){
        $tag = Tag::find($request->category_id);
        $tag->changeIsCategory();
        if ($tag->save()){
            return response()->json([
                'status' => 'success',
                'tag' => $tag
            ],200);
        }
        return response()->json([
            'status' => 'fail',
        ],404);

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
