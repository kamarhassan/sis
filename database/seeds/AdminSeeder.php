<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
// use Spatie\Permission\Models\Permission
class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        // DB::table('admins')->delete();

       Admin::create([
            'name' => 'Hassan Kamar',
            'email' => 'hassankamar795@gmail.com',
            'status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('123456789')
        ])->assignRole('super admin');




        Admin::create([
            'name' => 'Hassan Kamar 1',
            'email' => 'hassankamar7951@gmail.com',
            'status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('123456789')
        ])->assignRole('teacher');

        Admin::create([
            'name' => 'Hassan Kamar 2',
            'email' => 'hassankamar7952@gmail.com',
            'status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('123456789')
        ])->assignRole('edit_currency');

    }
}
