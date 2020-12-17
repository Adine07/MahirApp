<?php

namespace Database\Seeders;

use App\Models\ClientProject;
use Illuminate\Database\Seeder;

class ClientProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ClientProject::truncate();

        ClientProject::create([
            'client_id' => 1,
            'project_id' => 1,
        ]);

        ClientProject::create([
            'client_id' => 2,
            'project_id' => 2,
        ]);
    }
}
