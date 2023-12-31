<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/
Route::get('/cek', [BookController::class, 'cek']);

Route::get('/', function () {
    return view('home');
});

// Route::get('/register', [UserController::class, 'register_view']);
// Route::get('/login', [UserController::class, 'login_view']);

Route::post('/register', [UserController::class, 'register']);
Route::post('/login', [UserController::class, 'login']);
Route::get('/user', [UserController::class, 'profile']);
Route::delete('/user/logout', [UserController::class, 'logout']);