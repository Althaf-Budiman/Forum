<?php

use App\Http\Controllers\AuthenticationController;
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

Route::get('/', [QuestionController::class, 'home'])->middleware('auth');

// Authentication
Route::controller(AuthenticationController::class)->group(function() {
    Route::get('/register', 'registerView');
    Route::get('/login', 'loginView')->name('login');
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

// Question
Route::post('/question', [QuestionController::class, 'store']);

Route::get('/question/{id}/detail', [QuestionController::class, 'detailQuestion']);