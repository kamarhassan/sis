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
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'teacher', 'parent' => 'teacher', 'name' => 'teacher']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'language', 'name' => 'edit language']);

      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'grades']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'edit grades']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'create grades']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'grades', 'name' => 'delete grades']);

      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'levels']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'edit levels']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'create levels']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'levels', 'name' => 'delete levels']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'certificate', 'name' => 'edit certificate']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'certificate', 'name' => 'create certificate']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'certificate', 'name' => 'delete certificate']);

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

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'sponsore', 'name' => 'edit sponsor']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'sponsore', 'name' => 'delete sponsor']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'sponsore', 'name' => 'add sponsor']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'supervisor', 'name' => 'edit supervisor']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'supervisor', 'name' => 'delete supervisor']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'supervisor', 'name' => 'add supervisor']);


      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'slider', 'name' => 'edit slider']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'slider', 'name' => 'delete slider']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'slider', 'name' => 'add slider']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'institue information', 'name' => 'edit institue information']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'institue information', 'name' => 'delete institue information']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'setting', 'parent' => 'institue information', 'name' => 'add institue information']);


      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'cours']);
      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'show all cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'create cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'edit cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'delete cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'cours', 'parent' => 'cours', 'name' => 'info cours']);


      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'students']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'add students']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'show all students']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'register students']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'students', 'name' => 'payment students']);


      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'attendance', 'name' => 'attendance students']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'attendance', 'name' => 'report attendance']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'attendance', 'name' => 'reset']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'attendance', 'name' => 'enable or disable']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'sponsore', 'name' => 'edit students sponsore']);

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
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'certificate', 'name' => 'generate certificate']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'reports', 'name' => 'reports']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'reports', 'name' => 'view report']);

      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'services']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'payment remaining']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'register service to client']);
      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'services', 'name' => 'payment client to service']);

      // Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'old services receipt']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'edit old services receipt']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'delete old services receipt']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'old services payment', 'name' => 'print old services receipt']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'notification', 'name' => 'see notification']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular cours', 'name' => 'add popular cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular cours', 'name' => 'edit popular cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular cours', 'name' => 'delete popular cours']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular class', 'name' => 'add popular class']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular class', 'name' => 'edit popular class']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular class', 'name' => 'delete popular class']);






      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Blogs', 'parent' => 'Blogs', 'name' => 'create post']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Blogs', 'parent' => 'Blogs', 'name' => 'edit post']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Blogs', 'parent' => 'Blogs', 'name' => 'delete post']);


      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular class', 'name' => 'add school year']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'popular class', 'name' => 'edit school year']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'notification', 'name' => 'delete school year']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'marks', 'name' => 'enable or disable marks']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'students', 'parent' => 'marks', 'name' => 'reset marks']);


      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'notification', 'name' => 'low_stock']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'other', 'parent' => 'notification', 'name' => 'registration']);

      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' =>'create menu']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' =>'edit menu']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' =>'delete menu']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' =>'create page']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' =>'edit page']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' => 'delete page']);
      Permission::create(['guard_name' => 'admin', 'tab_name' => 'Cms', 'parent' => 'Cms', 'name' =>'edit design page']);



      $role = Role::create(['guard_name' => 'admin', 'name' => 'super admin']);
      $role->givePermissionTo(Permission::all());


      $role = Role::find(1);  //online 
      $role->syncPermissions(Permission::all());
   }
}
