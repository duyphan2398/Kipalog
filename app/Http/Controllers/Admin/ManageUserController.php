<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class ManageUserController extends Controller {
    public function index(){
        return view('admin.workspace.manageUser');
    }

    public  function show(){
        $users = User::withTrashed()->orderBy('created_at','desc')->paginate(4);
        return response()->json([
            'status' => 'success',
            'users' =>$users
        ],200);
    }

    /*Soft Delete*/
    public function delete(Request $request){
        $user = User::find($request->user_id);
        if ($user){
            if ($user->delete()){
                return response()->json([
                    'status' => 'success',
                ],200);
            }
        }
        else {
            $user = User::withTrashed()->find($request->user_id);
            if ($user){
                if ($user->restore()){
                    return response()->json([
                        'status' => 'success',
                    ],200);
                }
            }
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }

    /*Delete row*/
    public function deleteUserCompletely(Request $request){
        $user = User::withTrashed()->find($request->user_id);
        if ($user->forceDelete()){
            Post::where('user_id',$user->id)->delete();
            return response()->json([
                'status' => 'success',
            ],200);
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }
}
