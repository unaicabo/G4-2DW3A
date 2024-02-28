<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin'), // 'password
            'rol' => 'admin',
        ]);

        User::factory()->create([
            'name' => 'Player',
            'email' => 'notaplayer@gmail.com',
            'password' => bcrypt('player'), // 'password
            'rol' => 'player',
        ]);
    }
}
