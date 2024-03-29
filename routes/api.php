<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CoreController;

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

//Admin
Route::middleware('admin-login')->group(function () {
    Route::post('/auth/login', [AuthController::class, 'loginUser']);
});

Route::middleware('auth:admin')->group(function () {

    //auth
    Route::get('/user/getUser', [UserController::class, 'auth']);
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

    //user
    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/show/{user}', [UserController::class, 'show']);
    Route::post('/user/create', [UserController::class, 'create']);
    Route::patch('/user/edit/{user}', [UserController::class, 'edit']);
    Route::delete('/user/delete/{user}', [UserController::class, 'delete']);
    
    //consumer
    Route::get('/consumer', [ConsumerController::class, 'index']);
    Route::get('/consumer/show/{consumer}', [ConsumerController::class, 'show']);
    Route::patch('/consumer/edit/{consumer}', [ConsumerController::class, 'edit']);
    Route::delete('/consumer/delete/{consumer}', [ConsumerController::class, 'delete']);

    //blog
    Route::get('/blog', [BlogController::class, 'index']);
    Route::get('/blogCategories', [BlogController::class, 'categories']);
    Route::post('/blog/create', [BlogController::class, 'create']);
    Route::get('/blog/show/{blog}', [BlogController::class, 'show']);
    Route::patch('/blog/edit/{blog}', [BlogController::class, 'edit']);
    Route::delete('/blog/delete/{blog}', [BlogController::class, 'delete']);

    //stats
    Route::get('/stats', [CoreController::class, 'stats']);



});

//Consumer

//blog
Route::get('/blogs', [BlogController::class, 'blogList']);
Route::get('/blogs/{blog}', [BlogController::class, 'show']);

Route::middleware('consumer-login')->group(function () {
    Route::post('/consumer/login', [ConsumerController::class, 'loginUser']);
    Route::post('/consumer/signup', [ConsumerController::class, 'signupUser']);
});

Route::middleware('auth:consumer')->group(function () {

    //consumer
    Route::get('/consumer/getUser', [ConsumerController::class, 'auth']);
    Route::post('/consumer/logout', [ConsumerController::class, 'logoutUser']);
    Route::patch('/consumer/updateDetails/{consumer}', [ConsumerController::class, 'updateDetails']);
    Route::patch('/consumer/updatePassword/{consumer}', [ConsumerController::class, 'updatePassword']);

    
});
