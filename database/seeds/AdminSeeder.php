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



        Admin::create([
            'name' => 'Hassan Kamar',
            'email' => 'hassankamar795@gmail.com',
            'admin_status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('123456789')
        ])->assignRole('super admin');

        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'admin_status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('admin')
        ])->assignRole('super admin');


        Admin::create([
            'name' => 'Hassan Kamar 2',
            'email' => 'hassankamar7952@gmail.com',
            'admin_status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('123456789')
        ])->assignRole('edit_currency');





        for ($i = 0; $i < 15; $i++) {

            Admin::create([
                'name' => $faker->name(),
                'email' => $faker->email(),
                'admin_status' => '1',
                //'roles_name' => ['super-admin'],
                'password' => bcrypt('123456789')
            ])->assignRole('teacher');
        }
    }
}
