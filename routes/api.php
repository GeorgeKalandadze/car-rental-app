<?php

use App\Http\Controllers\Car\CreateCarController;
use App\Http\Controllers\Car\DeleteCarController;
use App\Http\Controllers\Car\GetCarController;
use App\Http\Controllers\Car\GetFavoriteCarsController;
use App\Http\Controllers\Car\ToggleFavoriteCarController;
use App\Http\Controllers\Car\UpdateCarController;
use App\Http\Controllers\CarPart\CreateCarPartController;
use App\Http\Controllers\CarPart\DeleteCarPartController;
use App\Http\Controllers\CarPart\GetCarPartController;
use App\Http\Controllers\CarPart\UpdateCarPartController;
use App\Http\Controllers\Company\CreateCompanyController;
use App\Http\Controllers\Company\DeleteCompanyController;
use App\Http\Controllers\Company\UpdateCompanyController;
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
    Route::prefix('cars')->group(function () {
        Route::get('/', GetCarController::class);
        Route::post('/create', CreateCarController::class);
        Route::put('/{id}', UpdateCarController::class);
        Route::delete('/{car}', DeleteCarController::class);
        Route::post('/{car}/toggle-favorite', ToggleFavoriteCarController::class);
        Route::get('/favorite-cars', GetFavoriteCarsController::class);
    });
    Route::prefix('car-parts')->group(function () {
        Route::get('/', GetCarPartController::class);
        Route::post('/create', CreateCarPartController::class);
        Route::put('/{id}', UpdateCarPartController::class);
        Route::delete('/{carPart}', DeleteCarPartController::class);
    });

    Route::prefix('companies')->group(function () {
        Route::post('/', CreateCompanyController::class);
        Route::put('/{company}', UpdateCompanyController::class);
        Route::delete('/{company}', DeleteCompanyController::class);
    });
});

require __DIR__.'/auth.php';
