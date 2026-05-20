<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\TopicController;
use App\Http\Controllers\LearningMaterialController;
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

// Learning Material by Category
Route::get('/vocabulary-materials', function () {
    return app(LearningMaterialController::class)->byCategory('Vocabulary');
});

Route::get('/grammar-materials', function () {
    return app(LearningMaterialController::class)->byCategory('Grammar');
});

Route::get('/quiz-materials', function () {
    return app(LearningMaterialController::class)->byCategory('Quiz');
});

Route::get('/daily-practice-materials', function () {
    return app(LearningMaterialController::class)->byCategory('Daily Practice');
});

// CRUD Learning Material
Route::get('/learning-materials', [LearningMaterialController::class, 'index']);
Route::get('/learning-materials/categories', [LearningMaterialController::class, 'categories']);
Route::get('/learning-materials/{id}', [LearningMaterialController::class, 'show']);
Route::post('/learning-materials', [LearningMaterialController::class, 'store']);
Route::put('/learning-materials/{id}', [LearningMaterialController::class, 'update']);
Route::patch('/learning-materials/{id}', [LearningMaterialController::class, 'update']);
Route::delete('/learning-materials/{id}', [LearningMaterialController::class, 'destroy']);
