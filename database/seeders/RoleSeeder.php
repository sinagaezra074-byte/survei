<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\Permission;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    public function run(): void
    {

        // ==========================
        // Ambil Data Permission
        // ==========================

        $guru = Permission::where('name', 'Guru')->first();

        $staff = Permission::where('name', 'Staff')->first();

        $operator = Permission::where('name', 'Operator')->first();



        // ==========================
        // Role Guru
        // ==========================

        $guruRole = Role::create([

            'name' => 'Guru',

            'description' => 'Role untuk pengguna Guru',

            'is_active' => true,

        ]);


        if ($guru) {

            $guruRole->permissions()->attach(
                $guru->id
            );
        }




        // ==========================
        // Role Staff
        // ==========================

        $staffRole = Role::create([

            'name' => 'Staff',

            'description' => 'Role untuk pengguna Staff',

            'is_active' => true,

        ]);


        if ($staff) {

            $staffRole->permissions()->attach(
                $staff->id
            );
        }




        // ==========================
        // Role Operator
        // ==========================

        $operatorRole = Role::create([

            'name' => 'Operator',

            'description' => 'Role untuk pengguna Operator',

            'is_active' => true,

        ]);


        if ($operator) {

            $operatorRole->permissions()->attach(
                $operator->id
            );
        }
    }
}
