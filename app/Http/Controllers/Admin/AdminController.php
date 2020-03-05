<?php

namespace App\Http\Controllers\Admin;
use App\Http\Requests\CreateAdminRequest;
use App\Models\Admin;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AdminController extends Controller
{
    public function __construct()
    {
    }

    public function index(){
        return view('admin.dashboard');
    }
    public function viewAdmin(){
        return view('admin.workspace.manageAdmin');
    }

    public function show(){
        $admins = Admin::orderBy('created_at', 'desc')->get();
        return response()->json([
            'status' => 'success',
            'admins' => $admins
        ]);
    }

    public function create(CreateAdminRequest $request){
        $admin = new Admin();
        $admin->fill($request->all());
        $admin->password = $request->password;
        if ($admin->save()){
            return response()->json([
                'status' => 'success',
                'admin' => $admin,
                'request' => $request
            ],200);
        }
        return response()->json([
            'status' => 'fail',
            'req' => $request
        ],404);
    }

    public function delete(Request $request){
        $admins = Admin::all();
        if ($admins->count() > 1){
            $admin = Admin::find($request->admin_id);
            if ($admin->delete()){
                return response()->json([
                    'status' => 'success',
                ],200);
            }
        }
        return response()->json([
            'status' => 'fail',
        ],404);
    }
}
