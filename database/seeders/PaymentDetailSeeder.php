<?php

namespace Database\Seeders;

use App\Models\PaymentDetail;
use Illuminate\Database\Seeder;

class PaymentDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        PaymentDetail::truncate();

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 1,
            'nominal' => 5000000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 1,
            'nominal' => 9000000,
        ]);

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 2,
            'nominal' => 2500000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 2,
            'nominal' => 2500000,
        ]);

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 3,
            'nominal' => 4000000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 3,
            'nominal' => 5000000,
        ]);

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 4,
            'nominal' => 2000000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 4,
            'nominal' => 4000000,
        ]);

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 5,
            'nominal' => 3500000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 5,
            'nominal' => 3500000,
        ]);

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 6,
            'nominal' => 2000000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 6,
            'nominal' => 2000000,
        ]);

        PaymentDetail::create([
            'user_id' => 1,
            'payment_id' => 7,
            'nominal' => 4000000,
        ]);

        PaymentDetail::create([
            'user_id' => 2,
            'payment_id' => 7,
            'nominal' => 5000000,
        ]);

    }
}
