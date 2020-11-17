<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Client::truncate();

        Client::create([
            'client_name' => 'Pak Muji',
            'email' => 'muji@muji',
            'whatsapp' => '089688*******',
            'company_name' => 'PT Maju Mundur',
            'provinces_id' => 33,
            'cities_id' => 3271,
            'districts_id' => 1607080,
            'villages_id' => 1305111001,
            'address' => 'Jl.Walisongo No.343 RW.3 RT.13 ',
        ]);

        Client::create([
            'client_name' => 'Pak jono',
            'email' => 'jono@jono',
            'whatsapp' => '089688*******',
            'company_name' => 'PT Maju Mundur',
            'provinces_id' => 33,
            'cities_id' => 3271,
            'districts_id' => 1607080,
            'villages_id' => 1305111001,
            'address' => 'Jl.Walisongo No.343 RW.3 RT.13 ',
        ]);
    }
}
