<?php

namespace Database\Seeders;

use App\Models\Payment;
use Illuminate\Database\Seeder;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Payment::truncate();

        Payment::create([
            'project_id' => 1,
            'date' => date("Y-m-d"),
            'nominal' => 15000000,
        ]);

        Payment::create([
            'project_id' => 1,
            'date' => '2020-11-21',
            'nominal' => 5000000,
        ]);

        Payment::create([
            'project_id' => 2,
            'date' => '2020-10-5',
            'nominal' => 10000000,
        ]);

        Payment::create([
            'project_id' => 2,
            'date' => '2020-11-5',
            'nominal' => 7000000,
        ]);

        Payment::create([
            'project_id' => 2,
            'date' => '2020-12-5',
            'nominal' => 8000000,
        ]);

        Payment::create([
            'project_id' => 3,
            'date' => '2020-11-5',
            'nominal' => 5000000,
        ]);

        Payment::create([
            'project_id' => 3,
            'date' => '2020-12-5',
            'nominal' => 10000000,
        ]);

    }
}
