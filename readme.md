##### Notes

@can('users.edit')
    <button>Edit User</button>
@endcan

@role('admin')
    <div>Admin-only content</div>
@endrole



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
