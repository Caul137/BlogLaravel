<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\Post;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', [Post::class, 'index'])->name('controllerPost');







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/admin/posts', [Post::class, 'indexAdmin'])->name('adminPost');
    Route::get('/admin/posts/create', [Post::class, 'createNewBlog'])->name('adminPostCreate');
    Route::post('/admin/posts/store', [Post::class, 'store'])->name('store');
    Route::get('/admin/posts/edit/{id}', [Post::class, 'edit'])->name('edit');
    Route::post('/admin/posts/update/{id}', [Post::class, 'update'])->name('update');
    Route::post('/admin/posts/delete/{id}', [Post::class, 'delete'])->name('delete');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
