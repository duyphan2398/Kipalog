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
/*Ajax routes*/
Route::group(['middleware' => ['check.isnot.admin']], function () {
    Route::get('getNewPosts', 'HomeController@getNewPosts');
    Route::get('getGoodPosts', 'HomeController@getGoodPosts');
    Route::get('search', 'HomeController@search');
    Route::get('getCommentsByPost/{post}', 'AjaxController@getCommentsByPost');
    Route::get('getPostsByTag/{tag}', 'AjaxController@getPostsByTag');
    Route::get('getPopularTags', 'AjaxController@getPopularTags');
    Route::get('getAllTags', 'AjaxController@getAllTags');
    Route::get('getAllTags', 'AjaxController@getAllTags');


});

Route::group(['middleware' => ['check.isnot.admin','auth']], function ()
{
    Route::get('deletePost/{post}', 'AjaxController@deletePost');
    Route::get('like/{post}','AjaxController@createLike');
    Route::get('changeState/{post}', 'AjaxController@changeStatePost');
    Route::post('post/create', 'PostController@create');
    Route::post('comment/create', 'AjaxController@createComment');
});
