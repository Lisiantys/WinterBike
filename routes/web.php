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

// Middleware Authentificate + Verified
Route::middleware(['auth', 'verified'])->group(function () {
    //Évènements
    Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
    Route::post('/events', [EventController::class, 'store'])->name('events.store');
    Route::get('/events/{event}/edit', [EventController::class, 'edit'])->name('events.edit');
    Route::put('/events/{event}', [EventController::class, 'update'])->name('events.update');
    Route::delete('/events/{event}', [EventController::class, 'destroy'])->name('events.destroy');

    Route::get('/mes-evenements', [EventController::class, 'myEvents'])->name('events.myEvents');

    //Routes Commentaires
    Route::post('events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
    Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');
});

//Route show en dessous de create, sinon Erreur 404 sur la route create
Route::get('/events/{event}', [EventController::class, 'show'])->name('events.show');

//Modérateurs et Administateurs + + Middleware Auth + Verif -> Event
Route::middleware(['auth', 'verified', 'moderatorOrAdmin'])->group(function () {
    Route::get('/evenements-en-attentes', [EventController::class, 'pending'])->name('events.pending');
    Route::patch('/evenements/{event}/valider', [EventController::class, 'validateEvent'])->name('events.validate');
});

//Administateurs + Middleware Auth + Verif
Route::middleware(['auth', 'verified', 'isAdmin'])->group(function () {
    Route::get('/gerer-utilisateurs', [ProfileController::class, 'manage'])->name('profile.manage');
    Route::put('/profile/{user}/update-role', [ProfileController::class, 'updateRole'])->name('profile.updateRole');
});


Route::get('/welcome', function(){
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
