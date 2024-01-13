<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\CommentController;
use App\Http\Controllers\Api\TaskController;
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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'auth'], function () {
    Route::post('login', [AuthController::class, 'login'])
        ->withoutMiddleware('auth:sanctum');
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'tasks'], function () {
    Route::patch('complete/{id}', [TaskController::class, 'complete']);
});

Route::apiResource('tasks', TaskController::class, ['middleware' => ['auth:sanctum']]);
Route::apiResource('tasks.comments', CommentController::class, ['middleware' => ['auth:sanctum']]);
