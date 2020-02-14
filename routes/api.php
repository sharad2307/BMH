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

Route::post('/login','Api\Auth\AuthController@login');
Route::post('/register','Api\Auth\AuthController@register');
// Route::post('/boysoption','Boys\BoysOption\HostelController@BoysOption');
Route::post('/BH/selectroommates','Api\Boys\BH\BoysHostelController@select_roommates');
Route::post('/ISH/selectroommates','Api\Boys\ISH\IshController@select_roommates');
Route::post('/checkresults','Api\Auth\CheckResultsController@checkdata');

