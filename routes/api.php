<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\FileController;
use App\Models\FileUpload;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/clients', function (FileUpload $fileUpload) {
    return response()->json($fileUpload->where('category', 'clients')->orderBy('order', 'ASC')->get());
})->name('clients');
Route::delete('/clients/{id}', [FileController::class, 'destroy'])->name('delete.clients');
Route::put('/clients/{id}', [FileController::class, 'updateOrderClients'])->name('update.clients');
Route::post('/contact', [ContactFormController::class, 'submit'])->name('contact');
Route::get('/applications', [ContactFormController::class, 'index'])->name('applications');
Route::post('/upload', [FileController::class, 'upload'])->name('upload');
