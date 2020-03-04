<?php


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
use  Illuminate\Http\Request;
/*Admin can not access here */
Route::group(['middleware' => ['check.isnot.admin']], function (){
    Route::get('/', 'HomeController@index')->middleware('check.isnot.admin');
    Route::get('viewpost/{post}','PostController@viewPost');
    Route::get('tag/{tag}', 'PostController@viewTag');
    Route::get('myPage/{user}', 'PostController@myPage');
});

/*Routes to authenticate user, If user are logged in, user cannot enter this routes*/
Route::group(['middleware' => ['check.login']], function ()
{
    Route::get('register','RegisterController@index');
    Route::post("register", 'RegisterController@create');
    Route::get('login','LoginController@index')->name('login');
    Route::post('login','LoginController@create');
    Route::get('resetpassword','ResetPasswordController@showLinkRequestForm');
    Route::post('resetpassword','ResetPasswordController@sendResetLinkEmail');
    Route::get("resetpassword/form/{token}/{email}", 'ResetPasswordController@resetPasswordForm');
    Route::post("resetpassword/form/{token}/{email}", 'ResetPasswordController@resetPassword');
});

/*Routes for user being logged in, Admin can not access this routes*/
Route::group(['middleware' => ['check.isnot.admin','auth']], function ()
{
    Route::get('setting', 'SettingController@index');
    Route::post('setting','SettingController@update')->name('setting');
    Route::get('logout','LoginController@logout');
    Route::get('myPosts', 'HomeController@myPosts');
    Route::get('newpost','PostController@index');

});



