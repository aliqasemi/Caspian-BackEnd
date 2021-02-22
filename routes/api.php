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

Route::group(['prefix' => 'caspian'], function (){
    Route::post('/register', [\App\Http\Controllers\Api\AuthController::class, 'register']);
    Route::post('/login', [\App\Http\Controllers\Api\AuthController::class, 'login']);

    Route::middleware('auth:api')->group(function (){
        Route::get('/logout', [\App\Http\Controllers\Api\AuthController::class, 'logout']);

        //Api
        Route::resources([
            'transplantations' => \App\Http\Controllers\Api\TransplantationController::class,
            'portfolios' => \App\Http\Controllers\Api\PortfolioController::class,
            'educations' => \App\Http\Controllers\Api\EducationController::class
        ]);
    });
});
