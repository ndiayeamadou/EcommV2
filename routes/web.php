<?php

use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PropertyController;
use App\Livewire\Admin\Category\CategoryManager;
use App\Livewire\Admin\Pos\Posales;
use App\Livewire\Admin\Product\ProductManager;
use App\Livewire\Admin\Product\ProductsList;
use App\Livewire\Admin\UserManagement;
use App\Livewire\Dashboard\AdminDashboard;
use App\Livewire\Frontend\Cart\CartShow;
use App\Livewire\Frontend\Checkout\Checkout;
use App\Livewire\Frontend\HomePage;
use App\Livewire\Frontend\Product\ProductDetail;
use App\Livewire\Frontend\Product\ProductList;
use App\Livewire\PostActions\PostIndex;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use Illuminate\Support\Facades\Route;

/* new 04/05 */
// routes/web.php

/* use App\Livewire\HomePage;
use App\Livewire\Shop\ProductList;
use App\Livewire\Shop\ProductDetail;
use App\Livewire\Shop\ShoppingCart;
use App\Livewire\Shop\Checkout;
use App\Livewire\Account\Dashboard as AccountDashboard;
use App\Livewire\Account\ProfileManager;
use App\Livewire\Account\OrderHistory;
use App\Livewire\Account\WishlistManager;
use App\Livewire\Admin\Dashboard as AdminDashboard;
use App\Livewire\Admin\CategoryManager;
use App\Livewire\Admin\ProductManager;
use App\Livewire\Admin\OrderManager;
use App\Livewire\Admin\CustomerManager;
use App\Livewire\Admin\UserManager;
use App\Livewire\Admin\ReportGenerator;
use Illuminate\Support\Facades\Route; */

// Guest Routes
Route::get('/', HomePage::class)->name('home');
//Route::get('/shop', ProductList::class)->name('shop');
Route::get('/categories/{category:slug}', ProductList::class)->name('category.show');
Route::get('/categories', CategoryManager::class)->name('categories');
//Route::get('/cart', ShoppingCart::class)->name('cart');
// Home and product routes
//Route::get('/', HomePage::class)->name('home');
Route::get('/products', ProductList::class)->name('products');
//Route::get('/products/{product:slug}', ProductDetail::class)->name('product.show');
Route::get('/products/{product:slug}', ProductDetail::class)->name('product.show');

// Cart routes
Route::get('/mon-panier', CartShow::class)->name('cart');
//Route::get('/checkout', CheckoutPage::class)->name('checkout');


// Authentication Routes

// Customer Account Routes
Route::middleware(['auth'])->group(function () {
    Route::prefix('account')->group(function () {
        //Route::get('/', AccountDashboard::class)->name('account.dashboard');
        //Route::get('/profile', ProfileManager::class)->name('account.profile');
        //Route::get('/orders', OrderHistory::class)->name('account.orders');
        //Route::get('/wishlist', WishlistManager::class)->name('account.wishlist');
        //Route::get('/checkout', Checkout::class)->name('checkout');
    });
});

// Admin Routes
//Route::middleware(['auth', 'role:admin'])->prefix('admin')->group(function () {
//Route::middleware(['auth', 'can:admin'])->prefix('admin')->group(function () {
Route::middleware(['auth', 'can:create categories'])->prefix('admin')->group(function () {
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
});

/* end */


/* using spatie */
Route::middleware(['auth', 'verified'])->prefix('admin')->group(function () {
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

Route::middleware(['permission:content.create'])->group(function () {
    // Routes that require 'content.create' permission
});

// Or for roles
Route::middleware(['role:admin'])->group(function () {
    // Routes that require 'admin' role
});



/* Route::get('/', function () {
    return view('welcome');
})->name('home'); */

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


Route::get('locale/{lang}', [LocaleController::class, 'switchLang'])->name('language.switch');


require __DIR__.'/auth.php';
