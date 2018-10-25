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


// Route::get('/article', 'ArticleController@index');
// Route::get('/artilce/{article}', 'ArticleController@show');
// Route::post('/article', 'ArticleController@store');
// Route::put('/article/{article}', 'ArticleController@update');
// Route::delete('/article/{article}', 'ArticleController@destroy');


Route::resource('/article', 'ArticleController');
