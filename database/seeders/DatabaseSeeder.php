<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(UserSeeder::class);
        $this->call(PaymentSeeder::class);
        $this->call(PaymentDetailSeeder::class);
        $this->call(ClientSeeder::class);
        $this->call(ClientProjectSeeder::class);
        $this->call(KasSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(CategorySeeder::class);
        $this->call(ScheduleSeeder::class);
        $this->call(ProjectSeeder::class);
        $this->call(ProjectMemberSeeder::class);
    }
}
