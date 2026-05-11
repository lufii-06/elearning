<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\SpeakingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


// Untuk lihat semua user
Route::get('/users', [UserController::class, 'index']);

// Untuk tambah user
Route::post('/users', [UserController::class, 'store']);

// Untuk hapus user
Route::delete('/users/{id}', [UserController::class, 'destroy']);

Route::post('/login', [UserController::class, 'login']);


// Update pakai PUT atau PATCH
Route::put('/users/{id}', [UserController::class, 'update']);

// CRUD Topic
Route::get('/topics', [TopicController::class, 'index']);
Route::get('/topics/{id}', [TopicController::class, 'show']);
Route::post('/topics', [TopicController::class, 'store']);
Route::put('/topics/{id}', [TopicController::class, 'update']);
Route::patch('/topics/{id}', [TopicController::class, 'update']);
Route::delete('/topics/{id}', [TopicController::class, 'destroy']);

// CRUD Speaking Material
Route::get('/speaking-materials', [SpeakingController::class, 'index']);
Route::get('/speaking-materials/{id}', [SpeakingController::class, 'show']);
Route::post('/speaking-materials', [SpeakingController::class, 'store']);
Route::put('/speaking-materials/{id}', [SpeakingController::class, 'update']);
Route::patch('/speaking-materials/{id}', [SpeakingController::class, 'update']);
Route::delete('/speaking-materials/{id}', [SpeakingController::class, 'destroy']);
