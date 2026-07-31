<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AdminUtamaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::updateOrCreate(
            [
                'email' => 'admin@ezra.com',
            ],
            [
                'name' => 'Admin Utama',
                'password' => Hash::make('admin3210'),
                'role' => 'admin_utama',
            ]
        );
    }
}
