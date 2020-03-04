<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\User;
class ManageUserController extends Controller {
    public function index(){
        return view('admin.workspace.manageUser');
    }

    public  function show(){
        $users = User::orderBy('created_at','desc')->paginate(3);
        return response()->json([
            'status' => 'success',
            'users' =>$users
        ],200);
    }
}
