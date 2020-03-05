<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class ManageTagController extends Controller {
    public function index(){
        return view('admin.workspace.manageTag');
    }

    public function  show(){
        $tags = Tag::orderBy('created_at','desc')->get();
        return response()->json([
            'status' => 'success',
            'tags' =>$tags,
        ],200);
    }

    public function create(Request $request){
        $tag = new Tag();
        $tag->name = $request->name;
        $tag->stripTags(['name']);
        if (Tag::where('name', 'like', '%'.$tag->name.'%')->get()->count() > 0) {
            return response()->json([
                'status' => 'Tag existed !',
            ],404);
        }
        if ($tag->save()){
            return response()->json([
                'status' => 'success',
                'tag' =>$tag,
            ],200);
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }

    public function delete(Request $request){
        $tag = Tag::find($request->id);
        $deleteInPivot = DB::table('posts_tags')->where('tag_id', '=', $tag->id)->delete();
        if ($deleteInPivot && $tag->delete()){
            return response()->json([
                'status' => 'success',
            ],200);
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }
}
