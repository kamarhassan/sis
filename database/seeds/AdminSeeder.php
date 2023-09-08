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
        $faker = \Faker\Factory::create();

        //    DB::table('admins')->delete();

        Admin::create([

            'name' => 'Hassan Kamar',
            'first_name' => 'Hassan Kamar',
            'middle_name' => 'Hassan Kamar',
            'last_name' => 'Hassan Kamar',
            'email' => 'sadmin@gmail.com',
            'admin_status' => 1,
            'passwordischanged' => 1,
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('1234')
        ])->assignRole('super admin');

        Admin::create([
            'name' => 'Hassan Kamar',
            'first_name' => 'Hassan Kamar',
            'middle_name' => 'Hassan Kamar',
            'last_name' => 'Hassan Kamar',
            'email' => 'admin@gmail.com',
            'admin_status' => '1',
            'passwordischanged' => 1,
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('1234')
        ])->assignRole('super admin');
       
        Admin::create([
            'name' => 'Hassan Kamar',
            'first_name' => 'Leila',
            'middle_name' => '-',
            'last_name' => 'Bartell',
            'email' => 'Leila@Bartell.com',
            'admin_status' => '1',
            'passwordischanged' => 1,
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('1234')
        ])->assignRole('teacher');






         for ($i = 0; $i < 15; $i++) {

             Admin::create([
                 'name' => $faker->name(),
                 'email' => $faker->email(),
                 'admin_status' => '1',
                 'password' => bcrypt('12345678')
             ])->assignRole('teacher');
         }
    }
}
