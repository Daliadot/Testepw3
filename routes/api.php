<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PlaylistController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/playlist',[PlaylistController::class, 'index']);
Route::put('/playlist/{id}',[PlaylistController::class,'update']);
Route::delete('/playlist/{id}',[PlaylistController::class,'destroy']);
Route::post('/playlist',[PlaylistController::class,'store']);
Route::get('/playlist/{id}',[PlaylistController::class,'show']);