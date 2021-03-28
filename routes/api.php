<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::group(['prefix' => 'caspian'], function () {
    Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function () {
        Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);
        Route::get('/user', [\App\Http\Controllers\Api\AuthController::class, 'user']);
        Route::post('/authorize/{user}', [\App\Http\Controllers\Api\AuthController::class, 'userAuthorize']);

        //Api
        Route::resources([
            'transplantations' => \App\Http\Controllers\Api\TransplantationController::class,
            'portfolios' => \App\Http\Controllers\Api\PortfolioController::class,
            'educations' => \App\Http\Controllers\Api\EducationController::class,
            'comments' => \App\Http\Controllers\Api\CommentController::class
        ]);
    });

    //search
    Route::group(['prefix' => 'search'], function () {
        Route::get('/educations', [\App\Http\Controllers\Api\EducationController::class, 'search']);
        Route::get('/portfolios', [\App\Http\Controllers\Api\PortfolioController::class, 'search']);
        Route::get('/transplantations', [\App\Http\Controllers\Api\TransplantationController::class, 'search']);

        Route::get('/all', [\App\Http\Controllers\Api\SearchController::class, 'search']);
    });
});
