<?php

use App\Models\Service;
use Illuminate\Database\Seeder;

class ServiceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        Service::create(['service' => 'Inernet 4G', 'fee' => '20', 'currencies_id' => '3']);
        Service::create(['service' => 'Inernet 3G', 'fee' => '15', 'currencies_id' => '3']);
        Service::create(['service' => 'Inernet 2G', 'fee' => '100000', 'currencies_id' => '1']);
        Service::create(['service' => 'English book', 'fee' => '200000', 'currencies_id' => '1']);
        Service::create(['service' => 'Ilets Exam', 'fee' => '200', 'currencies_id' => '3']);
       
    }
}
