<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Role::truncate();

        Role::create([
            'role' => 'Marketing'
        ]);

        Role::create([
            'role' => 'Senior Programmer'
        ]);

        Role::create([
            'role' => 'Programmer'
        ]);

        Role::create([
            'role' => 'UI Designer'
        ]);

        Role::create([
            'role' => 'UX Research'
        ]);

        Role::create([
            'role' => 'Full Stack Developer'
        ]);
    }
}
