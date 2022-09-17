<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // DB::table('nationalities')->delete();
        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();



        Permission::create(['guard_name' => 'admin', 'name' => 'setting']);
        Permission::create(['guard_name' => 'admin', 'name' => 'create_edit_grades']);
        Permission::create(['guard_name' => 'admin', 'name' => 'create_edit_levels']);
        Permission::create(['guard_name' => 'admin', 'name' => 'activate_currency']);
        Permission::create(['guard_name' => 'admin', 'name' => 'create_edit_services']);
        Permission::create(['guard_name' => 'admin', 'name' => 'create_edit_roles']);
        Permission::create(['guard_name' => 'admin', 'name' => 'cours']);
        Permission::create(['guard_name' => 'admin', 'name' => 'show_all_cours']);
        Permission::create(['guard_name' => 'admin', 'name' => 'add_cours']);
        Permission::create(['guard_name' => 'admin', 'name' => 'students']);
        Permission::create(['guard_name' => 'admin', 'name' => 'show all students']);
        Permission::create(['guard_name' => 'admin', 'name' => 'register_students']);
        Permission::create(['guard_name' => 'admin', 'name' => 'payment_students']);
        Permission::create(['guard_name' => 'admin', 'name' => 'receipt']);
        Permission::create(['guard_name' => 'admin', 'name' => 'reports']);
        Permission::create(['guard_name' => 'admin', 'name' => 'view report']);
        Permission::create(['guard_name' => 'admin', 'name' => 'services']);
        Permission::create(['guard_name' => 'admin', 'name' => 'register service to client']);
        Permission::create(['guard_name' => 'admin', 'name' => 'all services receipt']);
        Permission::create(['guard_name' => 'admin', 'name' => 'create_edit levels']);
        Permission::create(['guard_name' => 'admin', 'name' => 'activate currency']);
        Permission::create(['guard_name' => 'admin', 'name' => 'create_edit grades']);

        $role = Role::create(['guard_name' => 'admin', 'name' => 'super admin']);
        $role->givePermissionTo(Permission::all());


        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'admin', 'name' => 'teacher']);
        $role->givePermissionTo(['create_edit levels', 'create_edit grades']);
        // $role = Role::create(['guard_name' => 'admin','name' => 'writer']);
        // $role->givePermissionTo('add user ');
        $role = Role::create(['guard_name' => 'admin', 'name' => 'edit_currency']);
        $role->givePermissionTo('activate currency');
        // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        // ->givePermissionTo(['publish articles', 'unpublish articles']);


    }
}
