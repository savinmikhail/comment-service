<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\LotteryGameController;
use App\Http\Controllers\LotteryGameMatchController;
use App\Http\Controllers\LotteryGameMatchUserController;
use App\Http\Controllers\UserController;
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

Route::middleware('guest')->post('/users', [UserController::class, 'create']);

Route::group([
    'middleware' => 'jwt.auth',
], function ($router) {
    Route::get('/users',            [UserController::class, 'show']);
    Route::put('/users/{id}',       [UserController::class, 'update']);
    Route::delete('/users/{id}',    [UserController::class, 'delete']);

    Route::post('/comment',         [CommentController::class, 'create']);
    Route::get('/comment/{id}',     [CommentController::class, 'show']);
    Route::put('/comment/{id}',     [CommentController::class, 'update']);
    Route::delete('/comment/{id}',  [CommentController::class, 'delete']);
});

Route::group([
    'middleware' => 'api',
], function ($router) {
    Route::post('login',            [AuthController::class, 'login']);
    Route::post('logout',           [AuthController::class, 'logout']);
    Route::post('refresh',          [AuthController::class, 'refresh']);
    Route::post('me',               [AuthController::class, 'me']);
});



