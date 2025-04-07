##### Notes
###### Based on SpatieBase Getting Started
###### Erreurs - Errors - Correct the upload image in add and edit functionalities
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
