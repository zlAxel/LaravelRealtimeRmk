<?php

use App\Http\Controllers\ChatController;
use App\Http\Controllers\ProfileController;

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

Route::get('/', function () {
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

// ! Generamos vista para obtener a los usuarios
Route::view('/users', 'users.index')->middleware('auth')->name('users.index');

// ! Generamos ruta para la ruleta
Route::view('/ruleta', 'ruleta.index')->middleware('auth')->name('ruleta.index');

// ! Generamos ruta para el chat
Route::get('/chat', [ChatController::class, 'index'])->name('chat.index');
Route::post('/chat/message', [ChatController::class, 'store'])->name('chat.store');
Route::post('/chat/greet', [ChatController::class, 'greet'])->name('chat.greet');

require __DIR__.'/auth.php';
