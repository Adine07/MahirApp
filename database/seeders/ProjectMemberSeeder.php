<?php

namespace Database\Seeders;

use App\Models\ProjectMember;
use Illuminate\Database\Seeder;

class ProjectMemberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ProjectMember::truncate();

        ProjectMember::create([
            'project_id' => 1,
            'user_id' => 1,
            'role' => 'Marketing',
        ]);

        ProjectMember::create([
            'project_id' => 1,
            'user_id' => 2,
            'role' => 'Senior Programmer',
        ]);

        ProjectMember::create([
            'project_id' => 2,
            'user_id' => 1,
            'role' => 'Marketing',
        ]);

        ProjectMember::create([
            'project_id' => 2,
            'user_id' => 2,
            'role' => 'Full Stack Developer',
        ]);

        ProjectMember::create([
            'project_id' => 3,
            'user_id' => 1,
            'role' => 'Boss',
        ]);

        ProjectMember::create([
            'project_id' => 3,
            'user_id' => 2,
            'role' => 'Full Stack Programmer',
        ]);
    }
}
