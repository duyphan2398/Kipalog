<?php
use Illuminate\Support\Facades\Hash;
use App\Admin;
use  App\Http\Controllers\Admin\AdminController;
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

Route::get('/', function ()
{
    return view('welcome');
});

Route::group(['middleware' => ['checklogin']], function ()
{
    Route::get('register','RegisterController@index');
    Route::post("register", 'RegisterController@create');
    Route::get('login','LoginController@index')->name('login');
    Route::post('login','LoginController@create');
    Route::get('resetpassword','ResetPasswordController@sendEmail');
    Route::post('resetpassword','ResetPasswordController@resetPassword');
});

Route::get('logout','LoginController@logout')->middleware('auth');

Route::group(['middleware' => ['checkadmin']], function () {
        Route::get('dashboard','Admin\AdminController@index');
});


