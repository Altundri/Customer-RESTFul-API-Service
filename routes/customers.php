<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CustomerController;


Route::prefix('/customer')->group(function () {
    Route::get('', [CustomerController::class, 'getAll']);
    Route::get('{id}', [CustomerController::class, 'show']);
    Route::post('', [CustomerController::class, 'store']);
    Route::patch('/{id}', [CustomerController::class, 'update']);
    Route::delete('/{id}', [CustomerController::class, 'delete']);
});



