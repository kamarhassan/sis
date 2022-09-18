<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class onlynewpermission extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
       $new_Permission= Permission::create(['guard_name' => 'admin', 'name' => 'testingp']);

        // $role = Role::create(['guard_name' => 'admin', 'name' => 'super admin']);
        $role = Role::where('name','super admin');
        $role->givePermissionTo( $new_Permission);

    }
}
