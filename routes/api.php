<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\IdeaController;
use App\Http\Controllers\LikeController;
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

Route::prefix('auth')->group(function () {
    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);
    Route::get('check', [AuthController::class, 'check']);
    Route::post('logout', [AuthController::class, 'logout']);
});

Route::get('me', [AuthController::class, 'me']);

Route::middleware('auth')
    ->group(function () {
        Route::post('like/{idea}', [LikeController::class, 'like']);
        Route::post('unlike/{idea}', [LikeController::class, 'unlike']);
    });

Route::prefix('ideas')->group(function () {
    Route::post('create', [IdeaController::class, 'create'])->middleware('auth');
    Route::get('/idea/{idea}', [IdeaController::class, 'get']);
    Route::get('list', [IdeaController::class, 'list']);
});

Route::prefix('comments')->group(function () {
    Route::post('/', [CommentController::class, 'store'])->middleware('auth');
});


