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

/*Routes for admin login, if logged in, will request back*/
Route::group(['middleware' => ['check.login']], function () {
    Route::get('login', 'LoginController@index');
    Route::post('login', 'LoginController@login')->name('postLogin');
});

/*Routes for admin*/
Route::group(['middleware' => ['check.admin']], function () {
    Route::get('dashboard','AdminController@index');
    Route::get('logout','LoginController@logout');
});



/* Test Route: create admin*/
/*Route::get('admin', function(){
    $admin = new \App\Admin();
    $admin->name = 'admin2';
    $admin->email = 'duyphan@gmail.com';
    $admin->password = \Illuminate\Support\Facades\Hash::make('22157896a');
    $admin->avatar = 'images/default.png';
    $admin->save();
});*/
