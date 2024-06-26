<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EventController;
use App\Http\Controllers\CommentController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', [EventController::class, 'index'])->name('index');
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/profile/{user}', [ProfileController::class, 'show'])->name('profile.show');

Route::middleware('auth')->group(function () {
    
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('verified')->group(function () {
         
        Route::group(['prefix' => 'events'], function () {
            Route::get('/create', [EventController::class, 'create'])->name('events.create');
            Route::get('/{event}', [EventController::class, 'show'])->name('events.show');
            Route::post('/', [EventController::class, 'store'])->name('events.store');
            Route::get('/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
            Route::put('/{event}', [EventController::class, 'update'])->name('events.update');
            Route::delete('/{event}', [EventController::class, 'destroy'])->name('events.destroy');

            // Routes Commentaires
            Route::post('/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
            Route::delete('/comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
        });

        Route::get('/mes-evenements', [EventController::class, 'myEvents'])->name('events.myEvents');

        Route::get('/mes-favoris', [EventController::class, 'myFavorites'])->name('events.favorite');
        Route::post('favorites/add/{event}', [EventController::class, 'addFavorite'])->name('favorites.add');
        Route::delete('favorites/remove/{event}', [EventController::class, 'removeFavorite'])->name('favorites.remove');    

        // Modérateurs et Administrateurs
        Route::middleware('moderatorOrAdmin')->group(function () {
            Route::get('/evenements-en-attentes', [EventController::class, 'pending'])->name('events.pending');
            Route::post('/events/{event}/staff-message', [EventController::class, 'storeStaffMessage'])->name('events.storeStaffMessage');
            Route::patch('/events/{event}/valider', [EventController::class, 'validateEvent'])->name('events.validate');
        });

        // Administrateurs
        Route::middleware('isAdmin')->group(function () {
            Route::get('/gerer-utilisateurs', [ProfileController::class, 'manage'])->name('profile.manage');
            Route::put('/profile/{user}/update-role', [ProfileController::class, 'updateRole'])->name('profile.updateRole');
            Route::put('/profile/{user}/ban', [ProfileController::class, 'banUser'])->name('profile.banUser');
            Route::put('/profile/{user}/unban', [ProfileController::class, 'unbanUser'])->name('profile.unbanUser');
        });       
    });
});



Route::view('/mentions-legales', 'pages/mentions-legales')->name('mentions-legales');
Route::view('/politique-de-confidentialite', 'pages/politique-de-confidentialite')->name('politique-de-confidentialite');

require __DIR__.'/auth.php';
