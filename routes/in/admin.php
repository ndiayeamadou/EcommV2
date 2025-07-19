<?php


// Admin Routes
//Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Admin\Category\CategoryManager;
use App\Livewire\Admin\Order\OrderManager;
use App\Livewire\Admin\Pos\Posales;
use App\Livewire\Admin\Product\ProductManager;
use App\Livewire\Admin\Product\ProductsList;
use App\Livewire\Admin\UserManagement;
use App\Livewire\PostActions\PostIndex;
use Illuminate\Support\Facades\Route;


Route::middleware(['auth', 'can:create categories', 'isAdmin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', AdminDashboard::class)->name('dashboard');
    Route::get('/categories', CategoryManager::class)->name('categories');
    Route::get('/product/create', ProductManager::class)->name('products.create');
    Route::get('/products/{productId}/edit', ProductManager::class)->name('products.edit');
    Route::get('/products', ProductsList::class)->name('products');
    Route::get('/orders', OrderManager::class)->name('orders');
    Route::get('/posales', Posales::class)->name('posales');
    //Route::get('/customers', CustomerManager::class)->name('customers');
    //Route::get('/reports', ReportGenerator::class)->name('reports');
    Route::get('/post-create', \App\Livewire\PostActions\PostCreate::class)->name('post.create');
    Route::get('/posts', PostIndex::class)->name('posts.index');
    Route::get('/posts/{post}/edit', \App\Livewire\PostActions\PostEdit::class)->name('post.edit');

    Route::view('tasks', 'tasks')
        //->middleware(['auth', 'verified'])
        ->name('tasks');
});


/* using spatie */
Route::middleware(['auth', 'verified', 'isAdmin'])->name('admin.')->prefix('admin')->group(function () {
    Route::get('/dashboard', function () {
        return view('admindashboard');
    })->name('admindashboard');

    Route::get('/users', UserManagement::class)->name('users');
    
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



