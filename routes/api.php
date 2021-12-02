<?php

use App\Http\Controllers\ApplicationCategoriesController;
use App\Http\Controllers\ApplicationsController;
use App\Http\Controllers\CasesController;
use App\Http\Controllers\CategoriesCasesController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\UsersController;
use App\Models\CasesStatus;
use App\Models\FileUpload;
use GuzzleHttp\Client;
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

Route::get('cases-all', [CasesController::class, 'frontendCases'])->name('cases');

Route::apiResource('categories_cases', CategoriesCasesController::class)->names([
    'index' => 'api.categories.index',
    'store' => 'api.categories.store',
    'update' => 'api.categories.update',
    'destroy' => 'api.categories.destroy',
]);

Route::get('statuses', function (){
    return CasesStatus::all();
});

Route::post('upload', [FileController::class, 'upload'])->name('upload');

Route::middleware('auth:sanctum')->group(function () {
    Route::apiResource('users', UsersController::class)->names([
        'index' => 'users.index',
        'store' => 'users.store',
        'update' => 'users.edit',
        'destroy' => 'users.destroy',
    ]);
});

Route::get('sypexgeo', function (Client $client) {
    $body = $client->get('api.sypexgeo.net/json')->getBody();
    return json_decode($body);
})->name('sypexgeo');