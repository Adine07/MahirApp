<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::truncate();

        User::create([
            'name' => 'Manager',
            'email' => 'manager@manager',
            'password' => Hash::make('manager123'),
            'whatsapp' => '0896*********',
            'provinces_id' => 33,
            'cities_id' => 3271,
            'districts_id' => 1607080,
            'villages_id' => 1305111001,
            'address' => 'Jl.Walisongo No.343 RW.3 RT.13 ',
            'role' => 'manager',
            'income' => 0,
        ]);

        User::create([
            'name' => 'Employe',
            'email' => 'employe@employe',
            'password' => Hash::make('employe123'),
            'whatsapp' => '0896*********',
            'provinces_id' => 34,
            'cities_id' => 3671,
            'districts_id' => 2907080,
            'villages_id' => 2305111001,
            'address' => 'Jl.Uripsumoharjo No.434 RW.4 RT.14 ',
            'role' => 'employe',
            'income' => 0,
        ]);
    }
}
