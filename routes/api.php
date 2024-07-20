<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/',[\App\Http\Controllers\Client\HomeController::class,'index']);
Route::post('/register',[\App\Http\Controllers\Client\RegisterController::class,'store']);
Route::post('/login',[\App\Http\Controllers\Client\LoginController::class,'store']);
Route::middleware('auth:sanctum')->group(function (){
    Route::delete('/logout',[\App\Http\Controllers\Client\LoginController::class,'destroy']);
    Route::get('/user',[\App\Http\Controllers\Client\HomeController::class,'user']);
});
