<?php

use App\Models\Receipt;
use App\Models\Currency;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Auth\User;

class ReceiptSedder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()

    {
        $faker = \Faker\Factory::create();
        for ($i = 0; $i < 1500; $i++) {

            $paid_amount =  random_int(2000, 60000);
            $reamni =  random_int(0, 60000);

            Receipt::create([
                'currencies_id'=>Currency::inRandomOrder()->first()->id,
                'amount' =>  $reamni,
                // 'rate_exchange' => '',
                'amount_total' =>  $paid_amount,
                // 'transaction_id' => '',
                'description' => $faker->sentence,
                'payType' => 'pay_cache_',
                'user_id' => User::inRandomOrder()->first()->id,

            ]);
            # code...
        }











        //
    }
}
