<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\TransactionController;

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

Route::group(['middleware'=>'api', 'prefix'=>'v3'], function ($router){
    Route::post('/merchant/user/register', [AuthController::class, 'register']);
    Route::post('/merchant/user/login', [AuthController::class, 'login']);
    Route::post('/transactions/report', [TransactionController::class, 'report']);
    Route::post('/transactions/list', [TransactionController::class, 'list']);
    Route::post('/transactions', [TransactionController::class, 'transaction']);
    Route::post('/client', [TransactionController::class, 'client']);
});
