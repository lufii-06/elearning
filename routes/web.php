<?php

use App\Http\Controllers\Admin\AdminWebPackageController;
use App\Http\Controllers\LearningMaterialController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('learning.materials.index');
});

// ===== Learning Materials (sudah ada) =====
Route::get('/learning-materials', [LearningMaterialController::class, 'materials'])->name('learning.materials.index');
Route::get('/learning-materials/create', [LearningMaterialController::class, 'create'])->name('learning.materials.create');
Route::post('/learning-materials', [LearningMaterialController::class, 'storeWeb'])->name('learning.materials.store');
Route::get('/learning-materials/{id}/edit', [LearningMaterialController::class, 'editWeb'])->name('learning.materials.edit');
Route::put('/learning-materials/{id}', [LearningMaterialController::class, 'updateWeb'])->name('learning.materials.update');
Route::delete('/learning-materials/{id}', [LearningMaterialController::class, 'destroyWeb'])->name('learning.materials.destroy');

// ===== Admin: Paket Kursus =====
Route::prefix('admin')->name('admin.')->group(function () {
    Route::resource('packages', AdminWebPackageController::class);
});
