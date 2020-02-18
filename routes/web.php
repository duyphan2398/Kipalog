<?php
use Illuminate\Support\Facades\Hash;
use App\Admin;
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

Route::get('/', function () {
    return view('welcome');
});
Route::get('register','RegisterController@index');
Route::post("register", 'RegisterController@create');
Route::get('login','LoginController@index');
Route::post('login','LoginController@create');
Route::get('logout','LoginController@logout');

Route::get('/admin',function (){
   $admin = new \App\Admin();
   $admin->name = 'Duy Admin';
    $admin->username = 'admin';
    $admin->email = 'duyphan225@gmail.com';
    $admin->avatar = 'images/default.png';
    $admin->password = Hash::make('123');
    $admin->save();
});
