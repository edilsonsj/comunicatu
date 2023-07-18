<?php

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
Route::get('/leaflet', [ManifestationController::class, 'showMap']);

Route::middleware([
    'auth:sanctum',
    config('jetstream.auth_session'),
    'verified'
])->group(function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');
});
