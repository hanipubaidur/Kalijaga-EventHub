<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\EventController;

// Route::get('/user', function (Request $request) {
//     return $request->user();
// })->middleware('auth:sanctum');

Route::prefix('auth')->group(function () {
    Route::post('/register',[AuthController::class,'register']);
    Route::post('/login',[AuthController::class,'login']);
    Route::get('/me',[AuthController::class,'me'])->middleware(['auth:sanctum']);
    Route::get('/logout',[AuthController::class,'logout'])->middleware(['auth:sanctum']);
});


Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/create-event', function(){
    return 'create-event';
    })->Middleware(['ableCreateEvent']);

    Route::post('/user', [UserController::class, 'store'])->middleware(['ableCreateUser']);
    Route::get('/event', [EventController::class,'index']);
    Route::post('/event', [EventController::class, 'store'])->middleware(['ableCreateUpdateEvent']);
    Route::post('/event/{id}', [EventController::class, 'update'])->middleware(['ableCreateUpdateEvent']);
    Route::delete('/event/{id}', [EventController::class, 'destroy'])->middleware(['ableCreateUpdateEvent']);;


});
