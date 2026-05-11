<?php

use App\Http\Controllers\SpeakingController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('speaking.materials.index');
});

Route::get('/speaking-materials', [SpeakingController::class, 'materials'])->name('speaking.materials.index');
Route::get('/speaking-materials/create', [SpeakingController::class, 'create'])->name('speaking.materials.create');
Route::post('/speaking-materials', [SpeakingController::class, 'storeWeb'])->name('speaking.materials.store');
Route::get('/speaking-materials/{id}/edit', [SpeakingController::class, 'editWeb'])->name('speaking.materials.edit');
Route::put('/speaking-materials/{id}', [SpeakingController::class, 'updateWeb'])->name('speaking.materials.update');
Route::delete('/speaking-materials/{id}', [SpeakingController::class, 'destroyWeb'])->name('speaking.materials.destroy');
