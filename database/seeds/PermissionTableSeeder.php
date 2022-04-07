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

        // create permissions
        Permission::create(['guard_name' => 'admin','name' => 'create_edit levels']);
        Permission::create(['guard_name' => 'admin','name' => 'create_edit grades']);
        Permission::create(['guard_name' => 'admin','name' => 'activate currency']);
        // Permission::create(['guard_name' => 'admin','name' => 'unpublish articles']);

        // create roles and assign created permissions


        $role = Role::create(['guard_name' => 'admin','name' => 'super admin']);
        $role->givePermissionTo(Permission::all());


        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'admin','name' => 'teacher']);
        $role->givePermissionTo(['create_edit levels','create_edit grades']);
        // $role = Role::create(['guard_name' => 'admin','name' => 'writer']);
        // $role->givePermissionTo('add user ');
        $role = Role::create(['guard_name' => 'admin','name' => 'edit_currency']);
        $role->givePermissionTo('activate currency');
        // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        // ->givePermissionTo(['publish articles', 'unpublish articles']);


    }
}
