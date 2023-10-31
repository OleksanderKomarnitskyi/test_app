<?php

use App\Http\Controllers\Auth\OAuthController;
use App\Http\Controllers\PaymentController;
use App\Http\Controllers\PostController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::withoutMiddleware('auth:api')->prefix('auth')->group(function () {
    Route::post('/register', [OAuthController::class, 'register']);
    Route::post('/login', [OAuthController::class, 'login']);
});
Route::get('/logout', [OAuthController::class, 'logout']);

Route::get('/posts', [PostController::class, 'index']);
Route::post('/post', [PostController::class, 'store']);
Route::put('/post-update-status/{post}', [PostController::class, 'updateStatus']);

Route::post('/buy-tariff/{tariff}', [PaymentController::class, 'buyTariff']);

Route::any('{segment}', function () {
    return response('Not Found', 404);
})->where('segment', '.*');
