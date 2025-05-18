##### Notes
###### Based on SpatieBase Getting Started
Create flash-messages blade file in components to display flash messages
& create a helper class (ex Flash) => php artisan make:class Helpers/Flash

@can('users.edit')
    <button>Edit User</button>
@endcan

@role('admin')
    <div>Admin-only content</div>
@endrole

OR in middlware
Route::middleware(['auth', 'can:users.create'])->prefix('admin')->group(function () {});
https://spatie.be/docs/laravel-permission/v6/basic-usage/middleware



Additional Considerations
Add database migrations to extend the permissions table with a 'group' field if needed:

php artisan make:migration add_group_to_permissions_table
Implement the migration:

public function up()
{
    Schema::table('permissions', function (Blueprint $table) {
        $table->string('group')->default('general')->after('guard_name');
        $table->text('description')->nullable()->after('group');
    });
}



# Install additional helpful packages
composer require spatie/laravel-permission
composer require intervention/image
composer require stripe/stripe-php
composer require laravel/cashier
composer require barryvdh/laravel-dompdf
composer require cviebrock/eloquent-sluggable


php artisan install:api

php artisan make:controller Api/ProductController --api
php artisan make:controller Api/CategoryController --api
php artisan make:controller Api/CartController --api
php artisan make:controller Api/OrderController --api
php artisan make:controller Api/AuthController
