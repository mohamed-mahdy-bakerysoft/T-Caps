<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\FriendshipsController;

Route::get('/', function () {
    if (Auth::check()) {
        return view('dashboard');
    }
    else {
        return view('auth.login');
    }
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');



Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::resource('friends', FriendshipsController::class)->only(['index', 'create', 'store', 'edit', 'update', 'destroy']);
    Route::get('/friends/pending', [FriendshipsController::class, 'pending'])->name('friends.pending');
    Route::post('/friends/{friendship_id}/accept', [FriendshipsController::class, 'accept'])->name('friends.accept');
    Route::post('/friends/{friendship_id}/decline', [FriendshipsController::class, 'decline'])->name('friends.decline');



});


require __DIR__.'/auth.php';
