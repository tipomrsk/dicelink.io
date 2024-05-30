<?php

use App\Http\Controllers\CampaingController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::group(['prefix' => 'campaings'], function () {
    Route::get('/', [CampaingController::class, 'index']);
    Route::post('/', [CampaingController::class, 'store']);
    Route::get('/{campaing}', [CampaingController::class, 'show']);
    Route::put('/{campaing}', [CampaingController::class, 'update']);
    Route::delete('/{campaing}', [CampaingController::class, 'destroy']);
});
