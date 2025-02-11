<?php

use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Middleware\CanAdminLogin;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoreController;
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

//Admin
Route::post('/auth/login', [AuthController::class, 'loginUser'])->middleware(CanAdminLogin::class);


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

    //stats
    Route::get('/stats', [CoreController::class, 'stats']);
});