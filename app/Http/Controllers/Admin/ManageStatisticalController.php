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

    public function getPostsByDate($date, $state){
        return Post::whereDate('created_at', new Carbon($date))->whereState($state)->get()->count();
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
        $newPublicPostsToday = $this->getPostsByDate('today','Public' );
        $newPrivatePostsToday = $this->getPostsByDate('today','Private' );
        $newPublicPostsYesterday = $this->getPostsByDate('yesterday','Public' );
        $newPrivatePostsYesterday = $this->getPostsByDate('yesterday','Private' );
        return response()->json([
            'countListTags' => $countListTag,
            'newPublicPostsToday'  => $newPublicPostsToday,
            'newPrivatePostsToday'=> $newPrivatePostsToday,
            'newPublicPostsYesterday' => $newPublicPostsYesterday ,
            'newPrivatePostsYesterday' => $newPrivatePostsYesterday
        ],200);

    }
}
