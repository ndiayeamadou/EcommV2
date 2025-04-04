<?php

use App\Http\Controllers\PropertyController;
use App\Livewire\Dashboard\AdminDashboard;
use App\Livewire\PostActions\PostIndex;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

/* using spatie */
Route::middleware(['auth'])->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admindashboard');
    })->name('admindashboard');
    
    Route::get('/roles', function () {
        return view('roles');
    })->name('roles');
    
    Route::get('/permissions', function () {
        return view('permissions');
    })->name('permissions');
    
    Route::get('/user-roles', function () {
        return view('user-roles');
    })->name('user-roles');
});

Route::middleware(['permission:content.create'])->group(function () {
    // Routes that require 'content.create' permission
});

// Or for roles
Route::middleware(['role:admin'])->group(function () {
    // Routes that require 'admin' role
});



Route::get('/', function () {
    return view('welcome');
})->name('home');

Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');


Route::view('tasks', 'tasks')
    ->middleware(['auth', 'verified'])
    ->name('tasks');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');
});
/* 
Route::view('posts', 'posts')
    ->middleware(['auth', 'verified'])
    ->name('posts');
 */
Route::middleware(['auth', 'verified'])->group(function() {
    Route::get('/post-create', \App\Livewire\PostActions\PostCreate::class)->name('post.create');
    Route::get('/posts', PostIndex::class)->name('posts.index');
    Route::get('/posts/{post}/edit', \App\Livewire\PostActions\PostEdit::class)->name('post.edit');
} );
require __DIR__.'/auth.php';
