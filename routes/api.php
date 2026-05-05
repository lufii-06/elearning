<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
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
