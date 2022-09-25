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
            'password' => bcrypt('1234')
        ])->assignRole('super admin');

        Admin::create([
            'name' => 'admin',
            'email' => 'admin@gmail.com',
            'admin_status' => '1',
            //'roles_name' => ['super-admin'],
            'password' => bcrypt('1234')
        ])->assignRole('super admin');






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
