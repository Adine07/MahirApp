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
            'name' => 'Marketing'
        ]);

        Role::create([
            'name' => 'Senior Programmer'
        ]);

        Role::create([
            'name' => 'Programmer'
        ]);

        Role::create([
            'name' => 'UI Designer'
        ]);

        Role::create([
            'name' => 'UX Research'
        ]);

        Role::create([
            'name' => 'Full Stack Developer'
        ]);
    }
}
