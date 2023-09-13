<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CategoryController;
use App\Http\Controllers\Api\ImageController;
use App\Http\Controllers\Api\PostController;
use App\Http\Controllers\Api\TagController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\PageController;

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

Route::prefix('user')->group(function () {

    Route::get('/categories' , [CategoryController::class , 'index']);
    Route::post('/categories' , [CategoryController::class , 'store']);
    Route::post('/category/{id}' , [CategoryController::class , 'update']);
    Route::post('/category/{id}' , [CategoryController::class , 'destroy']);
});
Route::prefix('user')->group(function () {
    Route::get('/images' , [ImageController::class , 'index']);
    Route::post('/images' , [ImageController::class , 'store']);
    Route::post('/image/{id}' , [ImageController::class , 'update']);
    Route::post('/images/{id}' , [ImageController::class , 'destroy']);
});

Route::prefix('user')->group(function () {
    Route::get('/posts' , [PostController::class , 'index']);
    Route::post('/posts' , [PostController::class , 'store']);
    Route::post('/posts/{id}' , [PostController::class , 'update']);
    Route::post('/posts/{id}' , [PostController::class , 'destroy']);
});
Route::prefix('user')->group(function () {
    Route::get('/tags' , [TagController::class , 'index']);
    Route::post('/tags' , [TagController::class , 'store']);
    Route::post('/tags/{id}' , [TagController::class , 'update']);
    Route::post('/tags/{id}' , [TagController::class , 'destroy']);
});

Route::prefix('user')->group(function () {
    Route::get('/pages' , [PageController::class , 'index']);
    Route::post('/pages' , [PageController::class , 'store']);
    Route::post('/pages/{id}' , [PageController::class , 'update']);
    Route::post('/pages/{id}' , [PageController::class , 'destroy']);
});


Route::group([
    'middleware' => 'api',
    'prefix' => 'auth'
], function ($router) {
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::post('/refresh', [AuthController::class, 'refresh']);
    Route::get('/user-profile', [AuthController::class, 'userProfile']);
});
