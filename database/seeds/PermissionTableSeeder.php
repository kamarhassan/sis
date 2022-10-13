<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        DB::table('permissions')->delete();
        DB::table('role_has_permissions')->delete();
        DB::table('roles')->delete();
        DB::table('model_has_roles')->delete();

        // Reset cached roles and permissions
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();


        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'setting', 'name' => 'setting']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'language', 'name' => 'edit language']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'grades']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'edit grades']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'create grades']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'delete grades']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'levels']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'edit levels']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'create levels']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'delete levels']);

        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'activate_currency', 'name' => 'activate_currency']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'services', 'name' => 'setting services']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'services', 'name' => 'create setting services']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'services', 'name' => 'edit setting services']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'services', 'name' => 'delete setting services']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'roles', 'name' => 'roles']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'roles', 'name' => 'create roles']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'roles', 'name' => 'edit roles']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'roles', 'name' => 'delete roles']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'fee type', 'name' => 'fee type']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'fee type', 'name' => 'edit fee type']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'fee type', 'name' => 'create fee type']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'fee type', 'name' => 'delete fee type']);



        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'supervisor', 'name' => 'edit supervisor']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'supervisor', 'name' => 'delete supervisor']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'supervisor', 'name' => 'add supervisor']);


        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'cours']);
        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'show all cours']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'create cours']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'edit cours']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'delete cours']);


        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'show all students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'register students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'attendance students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'payment students']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'old payment students', 'name' => 'old payment students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'old payment students', 'name' => 'edit old payment students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'old payment students', 'name' => 'delete old payment students']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'old payment students', 'name' => 'print old payment students']);


        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'read only register order']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order delete all']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order deny all']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order read all']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order aprrove all']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order aprrove']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order delete']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'register order students', 'name' => 'register order deny']);

        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'reports', 'name' => 'reports']);

        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'reports', 'name' => 'view report']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'services']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'register service to client']);
        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'payment client to service']);

        // Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'old services receipt']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'edit old services receipt']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'delete old services receipt']);
        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'print old services receipt']);

        Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'notification', 'name' => 'see notification']);


        $role = Role::create(['guard_name' => 'admin', 'name' => 'super admin']);
        $role->givePermissionTo(Permission::all());

        Admin::find(1)->assignRole('super admin');
        // Admin::create([
        //     'name' => 'Hassan Kamar',
        //     'email' => 'samin@gmail.com',
        //     'admin_status' => '1',
        //     //'roles_name' => ['super-admin'],
        //     'password' => bcrypt('1234')
        // ])


        // this can be done as separate statements
        $role = Role::create(['guard_name' => 'admin', 'name' => 'teacher']);
        $role->givePermissionTo(['show all students', 'register students', 'attendance students',]);
        Admin::find(9)->assignRole('teacher');
        // $role = Role::create(['guard_name' => 'admin','tab_name'=>'','name' => 'writer']);
        // $role->givePermissionTo('add user ');
        // $role = Role::create(['guard_name' => 'admin','tab_name'=>'', 'name' => 'edit_currency']);
        // $role->givePermissionTo('activate currency');
        // or may be done by chaining
        // $role = Role::create(['name' => 'moderator'])
        // ->givePermissionTo(['publish articles', 'unpublish articles']);


    }
}
