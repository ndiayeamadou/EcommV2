<?php


// Admin Routes
//Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {

use App\Livewire\Admin\Category\CategoryManager;
use App\Livewire\Admin\Pos\Posales;
use App\Livewire\Admin\Product\ProductManager;
use App\Livewire\Admin\Product\ProductsList;
use App\Livewire\PostActions\PostIndex;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'can:create categories', 'isAdmin'])->prefix('admin')->group(function () {
    //Route::get('/', AdminDashboard::class)->name('admin.dashboard');
    Route::get('/categories', CategoryManager::class)->name('admin.categories');
    Route::get('/product/create', ProductManager::class)->name('admin.products.create');
    Route::get('/products/{productId}/edit', ProductManager::class)->name('admin.products.edit');
    Route::get('/products', ProductsList::class)->name('admin.products');
    //Route::get('/orders', OrderManager::class)->name('admin.orders');
    Route::get('/posales', Posales::class)->name('admin.posales');
    //Route::get('/customers', CustomerManager::class)->name('admin.customers');
    //Route::get('/users', UserManager::class)->name('admin.users');
    //Route::get('/reports', ReportGenerator::class)->name('admin.reports');
    Route::get('/post-create', \App\Livewire\PostActions\PostCreate::class)->name('post.create');
    Route::get('/posts', PostIndex::class)->name('posts.index');
    Route::get('/posts/{post}/edit', \App\Livewire\PostActions\PostEdit::class)->name('post.edit');
});


//require __DIR__.'/auth.php';