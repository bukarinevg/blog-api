<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PostController;
use App\Http\Controllers\api\v1\CommentController;
use App\Http\Controllers\AuthController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group([

    'middleware' => 'api',
    'prefix' => 'auth'

], function ($router) {

    Route::post('login', [AuthController::class,'login']);
    Route::post('logout', 'AuthController@logout');
    Route::post('refresh', 'AuthController@refresh');
    Route::post('me', 'AuthController@me');

});

//api/v1/posts
Route::group(['prefix' => 'v1', 'namespace' =>  'App\Http\Controllers\api\v1',  'middleware' => 'auth:api'], function(){
    Route::apiResource('posts', PostController::class); // PostController::class = 'App\Http\Controllers\api\v1\PostController'
    Route::apiResource('comments', CommentController::class);// CommentController::class = 'App\Http\Controllers\api\v1\CommentController'
    Route::post('posts/bulk', [PostController::class, 'bulkStore']);
});