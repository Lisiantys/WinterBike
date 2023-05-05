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

Route::get('/welcome', function(){
    return view('welcome');
});

Route::get('/mes-evenements', [EventController::class, 'myEvents'])->name('events.myEvents');

//Modérateurs et Administateurs (Middleware manquant)
Route::get('/evenements-en-attentes', [EventController::class, 'pending'])->name('events.pending');
Route::patch('/evenements/{event}/valider', [EventController::class, 'validateEvent'])->name('events.validate');

Route::resource('events', EventController::class);

//Routes Commentaires
Route::post('events/{event}/comments', [CommentController::class, 'store'])->name('comments.store');
Route::delete('comments/{comment}', [CommentController::class, 'destroy'])->name('comments.destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});



require __DIR__.'/auth.php';
