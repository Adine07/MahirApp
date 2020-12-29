<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Kas;

class KasSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Kas::truncate();

        Kas::create([
            'user_id' => 1,
            'date' => date("Y-m-d"),
            'income' => 1500000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'pak yudi',
            'description' => 'Hibah dana dari sana',
        ]);

        Kas::create([
            'user_id' => 1,
            'date' => date("Y-m-d"),
            'income' => 0,
            'expense' => 1200000,
            'category' => 'bulanan',
            'subject' => 'PLN',
            'description' => 'bayar tagihan listrik perusahaan',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 1,
            'date' => date("Y-m-d"),
            'income' => 1000000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'WebDesk',
            'description' => 'bayar project WebDesk termin ke 2',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 2,
            'date' => '2020-11-21',
            'income' => 500000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'WebDesk',
            'description' => 'bayar project WebDesk termin ke 1',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 3,
            'date' => '2020-10-5',
            'income' => 1000000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'Tukangku',
            'description' => 'bayar project tukangku termin ke 1',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 4,
            'date' => '2020-11-5',
            'income' => 1000000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'Tukangku',
            'description' => 'bayar project tukangku termin ke 2',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 5,
            'date' => '2020-12-5',
            'income' => 1000000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'Tukangku',
            'description' => 'bayar project tukangku termin ke 3',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 6,
            'date' => '2020-11-5',
            'income' => 1000000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'MU',
            'description' => 'bayar project MU termin ke 2',
        ]);

        Kas::create([
            'user_id' => 1,
            'payment_id' => 7,
            'date' => '2020-12-5',
            'income' => 1000000,
            'expense' => 0,
            'category' => 'pembayaran',
            'subject' => 'MU',
            'description' => 'bayar project MU termin ke 3',
        ]);
    }
}
