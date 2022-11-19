<?php

use App\Http\Controllers\UserModelController;
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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('users', [UserModelController::class, 'index']);
Route::get('users/{id}', [UserModelController::class, 'show']);
Route::post('user', [UserModelController::class, 'store']);
Route::post('users/{id}', [UserModelController::class, 'update']);
Route::delete('users/{id}', [UserModelController::class, 'destroy']);
Route::get('/users/search/{walletAddress}', [UserModelController::class, 'search']);
