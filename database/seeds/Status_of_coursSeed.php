<?php

use Illuminate\Database\Seeder;
use App\Models\Statusofcour;

class Status_of_coursSeed extends Seeder
{
    public function run()
    {
        Statusofcour::create(['name' => 'open']);
        Statusofcour::create(['name' => 'new']);
        Statusofcour::create(['name' => 'closed']);
        Statusofcour::create(['name' => 'canceled']);
        Statusofcour::create(['name' => 'postopened']);
    }
}
