<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([

            // Membuat Hak Akses
            PermissionSeeder::class,

            // Membuat Role dan hubungan Role Permission
            RoleSeeder::class,

            // Membuat akun Admin Utama
            AdminUtamaSeeder::class,

        ]);
    }
}
