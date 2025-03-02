<?php

use Illuminate\Support\Facades\Route;

//middleware
use App\Http\Middleware\CanAdminLogin;
use App\Http\Middleware\CanFrontendLogin;

//Controllers
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BlogController;
use App\Http\Controllers\Api\CoreController;
use App\Http\Controllers\Api\PageController;
use App\Http\Controllers\Api\UserController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\ThemeController;
use App\Http\Controllers\Api\ConsumerController;
use App\Http\Controllers\Api\PageSectionController;
use App\Http\Controllers\Api\PageSectionTemplateController;



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

//Theme 
Route::get('/theme/getTheme', [ThemeController::class, 'getActiveTheme']);

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

    //blog
    if ( env('MODULE_BLOG_ENABLED')) {
        Route::get('/blog', [BlogController::class, 'index']);
        Route::get('/blogCategories', [BlogController::class, 'categories']);
        Route::post('/blog/create', [BlogController::class, 'create']);
        Route::get('/blog/show/{blog}', [BlogController::class, 'show']);
        Route::patch('/blog/edit/{blog}', [BlogController::class, 'edit']);
        Route::delete('/blog/delete/{blog}', [BlogController::class, 'delete']);
    }

    //stats
    Route::get('/stats', [CoreController::class, 'stats']);

    //theme
    Route::post('/theme/setTheme', [ThemeController::class, 'setActiveTheme']);
    Route::get('/theme/getAllThemes', [ThemeController::class, 'getAllThemes']);

    //images
    Route::post('/image/upload', [ImageController::class, 'upload']);

    //cms
    if ( env('MODULE_CMS_ENABLED')) {
        Route::get('/pages/show/{page}', [PageController::class, 'getPageData']);
        Route::delete('/pages/delete/{page}', [PageController::class, 'delete']);
        Route::post('/pages/create', [PageController::class, 'create']);
        Route::post('/pages/addSection/{page}', [PageController::class, 'addSection']);
        Route::patch('/pages/edit/{page}', [PageController::class, 'edit']);

        //sections
        Route::patch('/pages/editSection/{pageSection}', [PageSectionController::class, 'edit']);
        Route::post('/pages/updateSectionOrder', [PageSectionController::class, 'updateSectionOrder']);
        Route::delete('/pages/deleteSection/{pageSection}', [PageSectionController::class, 'delete']);

        //templates
        Route::get('/pages/getTemplates', [PageSectionTemplateController::class, 'getTemplates']);

    }
});


//Route::get('/test/test', [TestController::class, 'index']);

//blog
if ( env('MODULE_BLOG_ENABLED')) {
    Route::get('/blogs', [BlogController::class, 'blogList']);
    Route::get('/blogs/{blog:slug}', [BlogController::class, 'show']);
}


//cms
if ( env('MODULE_CMS_ENABLED')) {
    Route::get('/pages', [PageController::class, 'index']);
    Route::get('/pages/{page:slug}', [PageController::class, 'getPageData']);
}

//Consumer
if ( env('MODULE_CONSUMER_ENABLED')) {

    Route::post('/consumer/login', [ConsumerController::class, 'loginUser'])->middleware(CanFrontendLogin::class);
    Route::post('/consumer/signup', [ConsumerController::class, 'signupUser'])->middleware(CanFrontendLogin::class);
   
    Route::middleware('auth:consumer')->group(function () {

        //consumer
        Route::get('/consumer/getUser', [ConsumerController::class, 'auth']);
        Route::post('/consumer/logout', [ConsumerController::class, 'logoutUser']);
        Route::patch('/consumer/updateDetails/{consumer}', [ConsumerController::class, 'updateDetails']);
        Route::patch('/consumer/updatePassword/{consumer}', [ConsumerController::class, 'updatePassword']);
    });
}
