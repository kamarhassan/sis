<?php

use App\Models\Admin;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\User;
use App\Models\Years;
use Modules\Cms\Entities\FooterSetting;

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
         'email' => 'kamarhassan044@gmail.com',
         'admin_status' => 1,
         'passwordischanged' => 1,
         //'roles_name' => ['super-admin'],
         'password' => bcrypt('1234')
      ])->assignRole('super admin');



      Years::create([
         'year'   => '2023-2024',
         'start'   => '2023-12-02',
         'end'   => '2024-12-02',
         'currentyear'   => 1,

      ]);







      FooterSetting::create([
         'key'=>     'footer_copy_right' ,
         'value'=>    '<h1>Aims Cpu&nbsp;</h1>' ,
         'created_at'=>     NULL  ,
         'updated_at'=>   '2023-06-16 15:50:04'   
      ]);

      FooterSetting::create([
         'key'=> 'footer_section_one_title'      ,
         'value'=>    'section one'  ,
         'created_at'=>     NULL  ,
         'updated_at'=>   '2023-06-16 15:50:04'   
      
      ]);
      FooterSetting::create([
         'key'=>    'footer_section_two_title'   ,
         'value'=>   'Company Info'  ,
         'created_at'=>     NULL  ,
         'updated_at'=>   '2023-06-16 15:50:04'   
      ]);
      FooterSetting::create([
         'key'=>     'footer_section_three_title'   ,
         'value'=>    'Explore Services' ,
         'created_at'=>     NULL  ,
         'updated_at'=>   '2023-06-16 15:50:04'   
         
      ]);
      FooterSetting::create([
         'key'=>     'footer_section_four_title'  ,
         'value'=>    'About Section'  ,
         'created_at'=>     NULL  ,
         'updated_at'=>   '2023-06-16 15:50:04'   

         ]);
      
     
      



      //   Admin::create([
      //       'name' => 'Hassan Kamar',
      //       'first_name' => 'Hassan Kamar',
      //       'middle_name' => 'Hassan Kamar',
      //       'last_name' => 'Hassan Kamar',
      //       'email' => 'admin@gmail.com',
      //       'admin_status' => '1',
      //       'passwordischanged' => 1,
      //       //'roles_name' => ['super-admin'],
      //       'password' => bcrypt('1234')
      //   ])->assignRole('super admin');

      //   Admin::create([
      //       'name' => 'Hassan Kamar',
      //       'first_name' => 'Leila',
      //       'middle_name' => '-',
      //       'last_name' => 'Bartell',
      //       'email' => 'Leila@Bartell.com',
      //       'admin_status' => '1',
      //       'passwordischanged' => 1,
      //       //'roles_name' => ['super-admin'],
      //       'password' => bcrypt('1234')
      //   ])->assignRole('teacher');


      // for ($i = 0; $i < 15; $i++) {

      //     Admin::create([
      //         'name' => $faker->name(),
      //         'email' => $faker->email(),
      //         'admin_status' => '1',
      //         'password' => bcrypt('12345678')
      //     ])->assignRole('teacher');
      // }

   }
}
