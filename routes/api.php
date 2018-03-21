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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});
Route::post('/user', "UserControl@register");
Route::get('/user',"UserControl@all");
Route::get('/user/{id}',"UserControl@find");
Route::delete('/user/{id}',"UserControl@delete");
Route::put('/updaterecord/{id}',"UserControl@updaterecord");
Route::get('users_item',"UserControl@list_all_users_item");
Route::get('users_item/{id}',"UserControl@list_users_item");

Route::post('/item',"ItemController@add_item");
Route::get('/item',"ItemController@all");
Route::get('/item/{id}',"ItemController@find");
Route::delete('/item/{id}',"ItemController@delete");
Route::put('/item/{id}',"ItemController@update_item");
