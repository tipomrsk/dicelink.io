<?php

use App\Http\Controllers\CampaingController;
use App\Http\Controllers\PlayerController;
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
    Route::get('/player/{player}', [CampaingController::class, 'allByPlayer']);
    Route::get('/owner/{player}', [CampaingController::class, 'allFromOwner']);
    // Minhas solicitações
    // Aceitar solicitação
    // Recusar solicitação
    // Preparar banco para receber solicitações
});

Route::group(['prefix' => 'players'], function () {
    Route::get('/', [PlayerController::class, 'index']);
    Route::post('/', [PlayerController::class, 'store']);
    Route::get('/{player}', [PlayerController::class, 'show']);
    Route::put('/{player}', [PlayerController::class, 'update']);
    Route::delete('/{player}', [PlayerController::class, 'destroy']);
    Route::post('/attach-to-campaing', [PlayerController::class, 'attachToCampaing']);
    Route::post('/detach-from-campaing', [PlayerController::class, 'detachFromCampaing']);
});
