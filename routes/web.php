<?php

use App\Http\Controllers\AnswerController;
use App\Http\Controllers\AuthenticationController;
use App\Http\Controllers\BookmarkController;
use App\Http\Controllers\DetailAnswerCommentController;
use App\Http\Controllers\NotificationController;
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
Route::controller(AuthenticationController::class)->group(function () {
    Route::get('/register', 'registerView');
    Route::get('/login', 'loginView')->name('login');
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
});

// should authenticate before accessing these route
Route::middleware('auth')->group(function () {
    // Create Question
    Route::post('/question', [QuestionController::class, 'store']);

    // Detail Question
    Route::get('/question/{id}/detail', [AnswerController::class, 'detailQuestion']);

    // Create Answer
    Route::post('/answer/{questionId}', [AnswerController::class, 'store']);

    // Detail Answer
    Route::get('/answer/{id}/detail', [DetailAnswerCommentController::class, 'detailAnswer']);

    // Detail Comment
    Route::get('/comment/{id}/detail', [DetailAnswerCommentController::class, 'detailComment']);

    // Bookmark List
    Route::get('/bookmarks', [BookmarkController::class, 'bookmarkView']);

    // Notification List
    Route::get('/notifications', [NotificationController::class, 'notificationView']);
});
