<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AddressController;


Route::prefix('/address')->group(function () {
    Route::get('', [AddressController::class, 'getAll']);
    Route::get('{id_address}', [AddressController::class, 'show']);
    Route::post('', [AddressController::class, 'store']);
    Route::patch('/{id_address}', [AddressController::class, 'update']);
    Route::delete('/{id_address}', [AddressController::class, 'delete']);
});
