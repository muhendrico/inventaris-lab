<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class KategoriSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Kategori::insert([
            ['nama' => 'Alat Ukur'],
            ['nama' => 'Bahan Kimia'],
            ['nama' => 'Elektronik'],
        ]);
    }
}
