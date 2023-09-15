<?php

use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\Api\AuthController;
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
   

    // route get join program page home webinar dan bootcamp limit 3
    Route::get('/get/join-program-page',[ApiController::class, 'getJoinProgramPage'])->name('getJoinProgramPage');

    // route get all in no limit webinar
    Route::get('/get/join-program-page/webinar',[ApiController::class, 'getJagoDalamSehariPage'])->name('getJagoDalamSehariPage');

    // insert jago dalam sehari 
    Route::post('/insert/jago-dalam-sehari/{webinar:identifier}/form',[ApiController::class, 'insertJagoDalamSehari'])->name('insertJagoDalamSehari');

    // views jago champ form
    Route::post('insert/jago-champ/form',[ApiController::class, 'insertJagoChamp'])->name('insertJagoChamp');

    // about us panel 
    Route::get('about-us/get', [ApiController::class, 'getAboutUs'])->name('getAboutUs');

    // pengecekan regster webinar 
    Route::get('checked/webinar/{webinar:identifier}', [ApiController::class, 'isRegisteredWebinar']);

    // pengecekan regster bootcamp
    Route::get('checked/bootcamp', [ApiController::class, 'isRegisteredBootcamp']);
});

