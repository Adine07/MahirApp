<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Seeder;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Project::truncate();

        Project::create([
            'project_name' => 'WebDesk',
            'status' => 'on-progress',
            'price' => '30000000',
            'start' => '2020-10-1',
            'finish' => '2020-12-30',
            'description' => 'WebDesk, membangun web untuk keperluan desa dan kelurahan',
        ]);

        Project::create([
            'project_name' => 'TukangQu',
            'status' => 'done',
            'price' => '25000000',
            'start' => '2020-11-5',
            'finish' => '2020-12-25',
            'description' => 'TukangQu, membangun web untuk keperluan Tukang dan keluarga',
        ]);

        Project::create([
            'project_name' => 'Website MU',
            'status' => 'done',
            'price' => '15000000',
            'start' => '2020-10-2',
            'finish' => '2020-11-5',
            'description' => 'Website MU, membangun web untuk keperluan Tukang dan keluarga',
        ]);
    }
}
