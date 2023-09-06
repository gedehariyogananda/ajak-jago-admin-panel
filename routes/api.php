<?php

use App\Http\Controllers\Api\AboutUsController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BootcampController;
use App\Http\Controllers\Api\WebinarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => 'api'], function () {

    // jwt login token api
    Route::prefix('auth')->group(function(){
        Route::post('/login', [AuthController::class, 'login']);
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::post('/refresh', [AuthController::class, 'refresh']);
        Route::get('/user-profile', [AuthController::class, 'userProfile']);
    });
   

    // route get webinar n insert
    Route::get('/get/webinar',[WebinarController::class, 'index']);
    Route::get('/get/webinar/{webinar:identifier}/shows',[WebinarController::class, 'pageShowWebinar']);
    Route::post('/get/webinar/{webinar:identifier}', [WebinarController::class,'pageInsertWebinar']);

    //checked is regitered or not
    Route::post('/get/webinar/{webinar:identifier}/check', [WebinarController::class,'isRegistered']);

    // route get about us
    Route::get('get/about-us',[AboutUsController::class,'index']);

    // route get bootcamp n insert
    Route::get('/get/bootcamp',[BootcampController::class, 'index']);
    Route::get('/get/bootcamp/register',[BootcampController::class, 'pageShowBootcamp']);
    Route::post('/get/bootcamp/{bootcamp:identifier}', [BootcampController::class,'pageInsertBootcamp']);

    
});

