<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ManagementController;
use App\Http\Controllers\ManifestationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/


Route::get('/', [ManifestationController::class, 'index']);
Route::get('/manifestations/create', [ManifestationController::class, 'create'])->middleware('auth');
Route::post('/manifestations', [ManifestationController::class, 'store']);

Route::get('manifestations/show', [ManifestationController::class, 'show'])->middleware('auth');
Route::get('manifestations/edit/{id}', [ManifestationController::class, 'edit']);

Route::put('/manifestations/update/{id}', [ManifestationController::class, 'update']);

Route::delete('manifestations/{id}', [ManifestationController::class, 'destroy']);

Route::get('/leaflet', [ManifestationController::class, 'getMarkers']);

Route::get('/manifestations/show/{id}', [ManifestationController::class, 'getById']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/welcome', function () {
        return view('welcome');
    })->name('welcome');
});

Route::get('/access-denied', [AdminController::class, 'accessDenied']);

// Management

Route::middleware(['web', 'admin'])->group(function () {
    Route::get('management/show', [ManagementController::class, 'index'])->middleware('auth');
    Route::get('management/show/{type?}', [ManagementController::class, 'index'])->name('management.index');
    Route::get('/management/edit/{id}', [ManagementController::class, 'editAdmin']);
    Route::put('/management/update/{id}', [ManagementController::class, 'update']);
});