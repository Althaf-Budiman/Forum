<?php

use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\QuestionController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', [HomeController::class, 'home'])->middleware('auth');

// Authentication
Route::controller(AuthenticationController::class)->group(function() {
    Route::get('/register', [AuthenticationController::class, 'registerView']);
    Route::get('/login', [AuthenticationController::class, 'loginView'])->name('login');
    Route::post('/register', [AuthenticationController::class, 'register']);
    Route::post('/login', [AuthenticationController::class, 'login']);
    Route::post('/logout', [AuthenticationController::class, 'logout']);
});


// Question
Route::post('/question', [QuestionController::class, 'store']);