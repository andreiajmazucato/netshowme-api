<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\VideoController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::get('videos', [VideoController::class, 'index']);
Route::get('videos/{id}', [VideoController::class, 'show']);
Route::patch('videos/{id}', [VideoController::class, 'update']);