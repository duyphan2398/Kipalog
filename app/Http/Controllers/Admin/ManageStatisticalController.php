<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Carbon;

class ManageStatisticalController extends Controller {
    public function index(){


        return view('admin.workspace.manageStatistical');
    }

    public function  show(){
        $tags = Tag::all();
        $countListTag =[];
        $sum = 0;
        foreach ($tags as $tag){
            $countListTag = Arr::add($countListTag,$tag->name,count($tag->posts));
            $sum+= count($tag->posts);
        }
        foreach (array_keys($countListTag) as $key){
            $countListTag[$key] =  round(($countListTag[$key]/$sum)*100, PHP_ROUND_HALF_DOWN);
        }
        $newPublicPostsToday = Post::whereDate('created_at', Carbon::today())->whereState('Public')->get()->count();
        $newPrivatePostsToday = Post::whereDate('created_at', Carbon::today())->whereState('Private')->get()->count();
        $newPublicPostsYesterday = Post::whereDate('created_at', Carbon::yesterday())->whereState('Public')->get()->count();
        $newPrivatePostsYesterday = Post::whereDate('created_at', Carbon::yesterday())->whereState('Private')->get()->count();
        return response()->json([
            'listTags' => $tag,
            'countListTags' => $countListTag,
            'newPublicPostsToday'  => $newPublicPostsToday,
            'newPrivatePostsToday'=> $newPrivatePostsToday,
            'newPublicPostsYesterday' => $newPublicPostsYesterday ,
            'newPrivatePostsYesterday' => $newPrivatePostsYesterday
        ],200);

    }
}
