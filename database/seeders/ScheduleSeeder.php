<?php

namespace Database\Seeders;

use App\Models\Schedule;
use Illuminate\Database\Seeder;

class ScheduleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schedule::truncate();

        Schedule::create([
            'name' => 'Tukangku Rapat',
            'day' => 'Sunday',
            'time' => '07.00 pm',
            'description' => 'lorem ipsum dolor sit amet',
        ]);

        Schedule::create([
            'name' => 'Rapat Bulan Agustus',
            'day' => 'Monday',
            'time' => '07.00 pm',
            'description' => 'Mbahas perkembangan mahir sejauh ini dan perkembangan 3 bulan terakhir',
        ]);

        Schedule::create([
            'name' => 'Konpeksiku Rapat',
            'day' => 'Tuesday',
            'time' => '07.00 pm',
            'description' => 'lorem ipsum dolor sit amet',
        ]);

        Schedule::create([
            'name' => 'Rapat Bulan September',
            'day' => 'Wednesday',
            'time' => '08.00 pm',
            'description' => 'Mbahas perkembangan mahir sejauh ini dan perkembangan 3 bulan terakhir',
        ]);

        Schedule::create([
            'name' => 'Mosok Rapat',
            'day' => 'Thursday',
            'time' => '07.00 pm',
            'description' => 'lorem ipsum dolor sit amet',
        ]);

        Schedule::create([
            'name' => 'Rapat Bulan Oktober',
            'day' => 'Friday',
            'time' => '08.00 pm',
            'description' => 'Mbahas perkembangan mahir sejauh ini dan perkembangan 3 bulan terakhir',
        ]);

        Schedule::create([
            'name' => 'Wow Rapat',
            'day' => 'Saturday',
            'time' => '07.00 pm',
            'description' => 'lorem ipsum dolor sit amet',
        ]);

        Schedule::create([
            'name' => 'Rapat Bulan Juny',
            'day' => 'Monday',
            'time' => '07.00 am',
            'description' => 'Mbahas perkembangan mahir sejauh ini dan perkembangan 3 bulan terakhir',
        ]);
    }
}
