<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BooksAPIController;
use App\Http\Controllers\AuthAPIController;

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

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});


Route::apiResource('books', BooksAPIController::class)->middleware('auth:sanctum');
Route::put('/books/{id}', [BooksAPIController::class, 'update'])->middleware('auth:sanctum');
Route::post('login', [AuthAPIController::class, 'login']);
Route::post('register', [AuthAPIController::class, 'register']);
Route::post('logout', [AuthAPIController::class, 'logout'])->middleware('auth:sanctum');

// Route::get('books', [BooksAPIController::class, 'index']);
// Route::get('books/{id}', [BooksAPIController::class, 'show']);
// Route::post('books', [BooksAPIController::class, 'store']);
// Route::put('books/{id}', [BooksAPIController::class, 'update']);
// Route::delete('books/{id}', [BooksAPIController::class, 'destroy']);