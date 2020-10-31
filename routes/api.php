<?php

use Illuminate\Support\Facades\Route;
use Api\V1\Users\Controllers\UserController;
use Api\V1\Users\Controllers\LoginController;
use Api\V1\Articles\Controllers\ArticleController;
use Api\V1\Categories\Controllers\CategoryController;
use Api\V1\Subscribers\Controllers\SubscriberController;

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

/*Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});*/


Route::prefix('v1')->group(function () {

    Route::apiResource("category", CategoryController::class, [
        "only" => ["index", "show"]
    ]);

    Route::apiResource("article", ArticleController::class, [
        "only" => ["index", "show"]
    ]);

    Route::post('login', [LoginController::class, "login"]);


    Route::group(['middleware' => ["auth:api"]], function () {
        Route::apiResource("category", CategoryController::class, [
            "only" => ["store", "update", "destroy"]
        ]);

        Route::apiResource("article", ArticleController::class, [
            "only" => ["store", "update", "destroy"]
        ]);

        Route::apiResource("subscriber", SubscriberController::class, [
            "only" => ["index", "store", "show", "destroy"]
        ]);

        Route::post('logout', [LoginController::class, "logout"]);

        Route::apiResource("user", UserController::class)
            ->middleware("role:" . config("role.admin"));
    });

});
