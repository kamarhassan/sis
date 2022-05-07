<?php

namespace Database\Seeders;

use App\Models\Cours;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use App\Models\User;
use Carbon\Carbon;

class students_registartion extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (range(1, 60) as $index) {
            DB::table('studentsRegistrations')->insert([
                'cours_id' => Cours::inRandomOrder()->first()->id,
                'user_id' => User::inRandomOrder()->first()->id,
                'notes' => '',
                'feesRequired' => '',
                // 'sponsorshipID'=>-1,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]);
        }
    }
}
