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

/*Authentication Routes*/
Route::group(['middleware' => ['check.isnot.admin']], function () {
    Route::get('getNewPosts', 'HomeController@getNewPosts');
    Route::get('getGoodPosts', 'HomeController@getGoodPosts');
    Route::get('search', 'HomeController@search');
    Route::get('getCommentsByPost/{post}', 'AjaxController@getCommentsByPost');
    Route::get('getPostsByTag/{tag}', 'AjaxController@getPostsByTag');
    Route::get('getPopularTagsCategories', 'AjaxController@getPopularTagsCategories');
    Route::get('getAllTags', 'AjaxController@getAllTags');
    Route::get('getAllTags', 'AjaxController@getAllTags');
});

/*Routes for Users*/
Route::group(['middleware' => ['check.isnot.admin','auth']], function ()
{
    Route::get('deletePost/{post}', 'AjaxController@deletePost');
    Route::get('like/{post}','AjaxController@createLike');
    Route::get('changeState/{post}', 'AjaxController@changeStatePost');
    Route::post('post/create', 'PostController@create');
    Route::post('comment/create', 'AjaxController@createComment');
});

/*Routes for Admin*/
Route::group(['middleware' => ['check.admin'], 'prefix' => 'admin'], function ()
{
    /*Manage User*/
    Route::get('getusers', 'Admin\ManageUserController@show');
    Route::delete('softDeleteUser','Admin\ManageUserController@delete');
    Route::delete('deleteUserCompletely', 'Admin\ManageUserController@deleteUserCompletely');

    /*Manage Post*/
    Route::get('getposts', 'Admin\ManagePostController@show');
    Route::delete('deletepost','Admin\ManagePostController@delete');

    /*Manage Admin*/
    Route::get('getadmins', 'Admin\AdminController@show');
    Route::post('newadmin', "Admin\AdminController@create");
    Route::delete('deleteadmin', "Admin\AdminController@delete");

    /*Manage Tag*/
    Route::get('gettags', 'Admin\ManageTagController@show');
    Route::post('newtag','Admin\ManageTagController@create');
    Route::delete('deletetag','Admin\ManageTagController@delete');

    /*Manage Category*/
    Route::get('getcategories', 'Admin\ManageCategoryController@show');
    Route::post('newcategory', 'Admin\ManageCategoryController@create');
    Route::patch('updatecategory','Admin\ManageCategoryController@update');
});

