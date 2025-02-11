<?php

use Illuminate\Support\Facades\Route;

//Controllers
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CoreController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Middleware\CanAdminLogin;
use App\Http\Middleware\CanFrontendLogin;

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
    
    //consumer
    if ( env('MODULE_CONSUMER_ENABLED')) {

        Route::get('/consumer', [ConsumerController::class, 'index']);
        Route::get('/consumer/show/{consumer}', [ConsumerController::class, 'show']);
        Route::patch('/consumer/edit/{consumer}', [ConsumerController::class, 'edit']);
        Route::delete('/consumer/delete/{consumer}', [ConsumerController::class, 'delete']);
    }

    //stats
    Route::get('/stats', [CoreController::class, 'stats']);

    //images
    Route::post('/image/upload', [ImageController::class, 'upload']);



});


//Route::get('/test/test', [TestController::class, 'index']);

//Consumer
if ( env('MODULE_CONSUMER_ENABLED')) {

    Route::post('/consumer/login', [ConsumerController::class, 'loginUser'])->middleware(CanFrontendLogin::class);;;
    Route::post('/consumer/signup', [ConsumerController::class, 'signupUser'])->middleware(CanFrontendLogin::class);;;

    Route::middleware('auth:consumer')->group(function () {
        //consumer
        Route::get('/consumer/getUser', [ConsumerController::class, 'auth']);
        Route::post('/consumer/logout', [ConsumerController::class, 'logoutUser']);
        Route::patch('/consumer/updateDetails/{consumer}', [ConsumerController::class, 'updateDetails']);
        Route::patch('/consumer/updatePassword/{consumer}', [ConsumerController::class, 'updatePassword']);

    });
}
