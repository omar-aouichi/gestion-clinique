<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\StockController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::prefix('stock')->group(function () {
    Route::get('/', [StockController::class, 'index']);
    Route::post('/mouvement', [StockController::class, 'mouvement']);
    Route::get('/pump', [StockController::class, 'pump']);
    Route::post('/verifier-expiration', [StockController::class, 'verifierExpiration']);
    Route::get('/alerts', [StockController::class, 'checkThresholds']);
    Route::get('/filter', [StockController::class, 'listByCriteria']);
});
