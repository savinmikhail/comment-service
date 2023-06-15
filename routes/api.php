<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
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

///**
// * @SWG\Swagger(
// *   schemes={"http", "https"},
// *   basePath="/api",
// *   @SWG\Info(
// *     title="API Documentation",
// *     version="1.0.0",
// *     description="API endpoints for authentication"
// *   )
// * )
// */

Route::middleware('guest')->post('/users', [UserController::class, 'create']);

Route::group(['middleware' => 'jwt.auth',], function ($router) {
    Route::get('/users',            [UserController::class, 'show']);
    Route::put('/users/{id}',       [UserController::class, 'update']);
    Route::delete('/users/{id}',    [UserController::class, 'delete']);

    Route::post('/comment',         [CommentController::class, 'create']);
    Route::get('/comment/{id}',     [CommentController::class, 'show']);
    Route::put('/comment/{id}',     [CommentController::class, 'update']);
    Route::delete('/comment/{id}',  [CommentController::class, 'delete']);
});

Route::group(['middleware' => 'api',], function ($router) {



    Route::post('login',            [AuthController::class, 'login']);


//    /**
//     * @SWG\Post(
//     *   path="/logout",
//     *   tags={"Auth"},
//     *   summary="User logout",
//     *   @SWG\Response(response="200", description="Successful logout"),
//     *   @SWG\Response(response="401", description="Unauthorized")
//     * )
//     */
    Route::post('logout',           [AuthController::class, 'logout']);


//    /**
//     * @SWG\Post(
//     *   path="/refresh",
//     *   tags={"Auth"},
//     *   summary="Refresh authentication token",
//     *   @SWG\Response(response="200", description="Successful token refresh"),
//     *   @SWG\Response(response="401", description="Unauthorized")
//     * )
//     */
    Route::post('refresh',          [AuthController::class, 'refresh']);

//    /**
//     * @SWG\Post(
//     *   path="/me",
//     *   tags={"Auth"},
//     *   summary="Get authenticated user's details",
//     *   @SWG\Response(response="200", description="Successful retrieval"),
//     *   @SWG\Response(response="401", description="Unauthorized")
//     * )
//     */
    Route::post('me',               [AuthController::class, 'me']);
});



