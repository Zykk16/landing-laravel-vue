<?php

use App\Http\Controllers\ApplicationCategoriesController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\CategoriesCasesController;
use App\Http\Controllers\FileController;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('clients', function (FileUpload $fileUpload) {
    return response()->json($fileUpload->where('category', 'clients')->orderBy('order', 'ASC')->get());
})->name('clients');

Route::delete('clients/{id}', [FileController::class, 'destroy'])->name('delete.clients');
Route::put('clients/{id}', [FileController::class, 'updateOrderClients'])->name('update.clients');
Route::post('contact', [ApplicationsController::class, 'submit'])->name('contact');
Route::get('applications', [ApplicationsController::class, 'index'])->name('applications');
Route::get('application-categories', [ApplicationCategoriesController::class, 'index'])->name('application-categories');

Route::resource('cases', CasesController::class)->names([
    'index' => 'cases.index',
    'store' => 'cases.store',
    'update' => 'cases.edit',
    'destroy' => 'cases.destroy',
]);

Route::apiResource('categories_cases', CategoriesCasesController::class)->names([
    'index' => 'api.categories.index',
    'store' => 'api.categories.store',
    'update' => 'api.categories.update',
    'destroy' => 'api.categories.destroy',
]);

Route::post('upload', [FileController::class, 'upload'])->name('upload');
