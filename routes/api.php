<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Api\TestController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\UserController;

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

Route::post('/auth/login', [AuthController::class, 'loginUser']);
//Route::get('/user', [UserController::class, 'show']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/test', [TestController::class, 'index']);

    Route::get('/user', [UserController::class, 'show']);
});

//Route::get('/test', [TestController::class, 'index']);
Route::post('/test', [TestController::class, 'post']);

