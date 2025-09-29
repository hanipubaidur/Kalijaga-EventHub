<?php

namespace Database\Seeders;

use App\Models\Kategory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class KategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        Kategory::truncate();
        Schema::enableForeignKeyConstraints();

        $data = [
            'Akademik','Kuliner','Seni & Budaya','Kompetensi/Lomba','Organisai','Keagamaan','Sosial & Pengabdian', 'Lain-Lain'
        ];

        foreach ($data as $value)
            {
                Kategory::insert([
                    'kategoriName'=> $value,
                    'created_at' => now(),
                    'updated_at'=> now()
                ]);
            } 
    }
}
