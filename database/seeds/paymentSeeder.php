<?php

use App\Models\Payment;
use App\Models\CoursFee;
use App\Models\Receipt;
use Illuminate\Database\Seeder;
use App\Models\StudentsRegistration;

class paymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        

      

        for ($i = 0; $i < 2000; $i++) {
            $paid_amount=random_int(2000, 60000);
            $reamni = random_int(1000, 40000);
            Payment::create([
                'amount' => $paid_amount,
                'paid_amount' => $paid_amount,
                'remaining' => $reamni,
                'studentsRegistration_id' => StudentsRegistration::inRandomOrder()->first()->id,
                'cours_fee_id' => CoursFee::inRandomOrder()->first()->id,
                'receipt_id' =>  Receipt::inRandomOrder()->first()->id,

            ]);
        }
    }
}
