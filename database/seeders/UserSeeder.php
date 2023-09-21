<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'nawfal',
            'email' => 'nawfal@gmail.com',
            'password' => 'nawfal123',
            'profile_photo_path' => 'profile-photos/default-profile-photo.png'
        ]);

        User::create([
            'name' => 'budiman',
            'email' => 'budiman@gmail.com',
            'password' => 'budiman123',
            'profile_photo_path' => 'profile-photos/black-belt.jpg'
        ]);

        User::create([
            'name' => 'apakah',
            'email' => 'apakah@gmail.com',
            'password' => 'apakah123',
            'profile_photo_path' => 'profile-photos/ronaldo.jpg'
        ]);
    }
}
