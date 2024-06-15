<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;

Route::get('/events', [EventController::class, 'index']);
Route::post('/events', [EventController::class, 'store']);


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');
