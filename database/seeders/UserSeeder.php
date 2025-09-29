<?php

namespace Database\Seeders;

use App\Models\User;
use Hash;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        User::truncate();
        Schema::enableForeignKeyConstraints();

        User::insert([
            'name' => 'Admin',
            'email' => 'adm@email.com',
            'password' => Hash::make('adm123'),
            'role_id' => 1
        ]);
    }
}
