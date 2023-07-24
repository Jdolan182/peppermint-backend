<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ConsumerController;

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

//Route::get('/user', [UserController::class, 'show']);

Route::middleware('auth:admin')->group(function () {

    Route::get('/user/getUser', [UserController::class, 'auth']);
    Route::post('/auth/logout', [AuthController::class, 'logoutUser']);

    Route::get('/user', [UserController::class, 'index']);
    Route::get('/user/show/{user}', [UserController::class, 'show']);
    Route::post('/user/create', [UserController::class, 'create']);
    Route::patch('/user/edit/{user}', [UserController::class, 'edit']);
    Route::delete('/user/delete/{user}', [UserController::class, 'delete']);
    
    Route::get('/consumer', [ConsumerController::class, 'index']);
    Route::get('/consumer/show/{consumer}', [ConsumerController::class, 'show']);
    Route::patch('/consumer/edit/{consumer}', [ConsumerController::class, 'edit']);
    Route::delete('/consumer/delete/{consumer}', [ConsumerController::class, 'delete']);


});

//Consumer
Route::middleware('consumer-login')->group(function () {
    Route::post('/consumer/login', [ConsumerController::class, 'loginUser']);
    Route::post('/consumer/signup', [ConsumerController::class, 'signupUser']);
});

Route::middleware('auth:consumer')->group(function () {

    //consumer
    Route::get('/consumer/getUser', [ConsumerController::class, 'auth']);
    Route::post('/consumer/logout', [ConsumerController::class, 'logoutUser']);

});

//Route::get('/test', [TestController::class, 'index']);
Route::get('/test', [TestController::class, 'post']);

