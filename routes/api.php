<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\api\v1\PostController;
use App\Http\Controllers\api\v1\CommentController;

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

//api/v1/posts
Route::group(['prefix' => 'v1', 'namespace' =>  'App\Http\Controllers\api\v1'], function(){
    Route::apiResource('posts', PostController::class); // PostController::class = 'App\Http\Controllers\api\v1\PostController'
    Route::apiResource('comments', CommentController::class);// CommentController::class = 'App\Http\Controllers\api\v1\CommentController'
});