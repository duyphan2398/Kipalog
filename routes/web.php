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
/*Trang chính, nếu là admin thì không cho vào trang này*/
Route::get('/', 'HomeController@index')->middleware('check.isnot.admin');

/*Nhóm routes thao tác trên trang chính và để gọi ajax*/
Route::group(['prefix' =>'ajax'], function (){
    Route::get('baivietmoi','HomeController@baiVietMoi');
    Route::get('baiviethay','HomeController@baiVietHay');
    Route::post('search','HomeController@search');

    Route::get('tags','AjaxController@getTags');

});
/*Nhóm route xác thực người dùng, nếu login rồi thì không vào được nữa, kể cả admin lẫn User*/
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

/*Nhóm route cho người dùng đã đăng nhập và Đá admin ra khoỉ các trang hoạt động của User*/
Route::group(['middleware' => ['check.isnot.admin','auth']], function ()
{
    Route::get('logout','LoginController@logout');
    Route::get('user/posts', 'HomeController@myPost');
    Route::get('newpost','PostController@index');
    Route::post('newpost',function (Request $request) {
        dd($request->skill);
    });



});



