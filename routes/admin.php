<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

/*Nhóm xác thực admin, nếu đăng nhập rồi thì không vào được*/
Route::group(['middleware' => ['check.login']], function () {
    Route::get('login', 'LoginController@index');

    Route::post('login', 'LoginController@login')->name('postLogin');
});

/*Nhóm các route chỉ Admin mới được dùng*/
Route::group(['middleware' => ['check.admin']], function () {
    Route::get('dashboard','AdminController@index');
    Route::get('logout','LoginController@logout');
});



/* Test Route: create admin*/
Route::get('admin', function(){
    $admin = new \App\Admin();
    $admin->name = 'admin2';
    $admin->email = 'duyphan@gmail.com';
    $admin->password = \Illuminate\Support\Facades\Hash::make('22157896a');
    $admin->avatar = 'images/default.png';
    $admin->save();
});
