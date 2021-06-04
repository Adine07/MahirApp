<?php

namespace Database\Seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        Category::create([
            'name' => 'Pembayaran'
        ]);

        Category::create([
            'name' => 'Pegeluaran'
        ]);

        Category::create([
            'name' => 'Pegeluaran Bulanan'
        ]);

        Category::create([
            'name' => 'Pemasukkan'
        ]);

        Category::create([
            'name' => 'Bagi Hasil'
        ]);

        Category::create([
            'name' => 'Utang'
        ]);
    }
}