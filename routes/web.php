<?php

use App\Http\Controllers\Controller;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PostController\PostController;
use App\Http\Controllers\AdminController\AdminController;
use App\Http\Controllers\HomePageController\HomePageController;





Route::get('/', [HomePageController::class, 'index'])->name('controllerPost');
Route::get('/post{id}', [PostController::class, 'posts'])->name('post');
Route::post('/commented', [PostController::class, 'commented'])->name('commented');
Route::get('/noPost{id}', [PostController::class, 'noPost'])->name('noPost');
Route::get('/comment/delete/{id}', [PostController::class, 'deleteComment'])->name('commentDelete');







Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::get('/admin/posts', [AdminController::class, 'indexAdmin'])->name('adminPost');
    Route::get('/admin/posts/create', [AdminController::class, 'createNewBlog'])->name('adminPostCreate');
    Route::post('/admin/posts/store', [AdminController::class, 'store'])->name('store');
    Route::get('/admin/posts/edit/{id}', [AdminController::class, 'edit'])->name('edit');
    Route::post('/admin/posts/update/{id}', [AdminController::class, 'update'])->name('update');
    Route::post('/admin/posts/delete/{id}', [AdminController::class, 'delete'])->name('delete');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
