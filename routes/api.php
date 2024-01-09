<?php

use App\Http\Controllers\CreateCarController;
use App\Http\Controllers\DeleteCarController;
use App\Http\Controllers\GetCarController;
use App\Http\Controllers\ToggleFavoriteCarController;
use App\Http\Controllers\UpdateCarController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();

});

Route::middleware(['auth:sanctum'])->group(function () {
    Route::post('/car', CreateCarController::class);
    Route::put('/cars/{id}', UpdateCarController::class);
    Route::delete('/cars/{car}', DeleteCarController::class);
    Route::get('/cars', GetCarController::class);
    Route::post('/cars/{car}/toggle-favorite', ToggleFavoriteCarController::class);
});

require __DIR__.'/auth.php';
