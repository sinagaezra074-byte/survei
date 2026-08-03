<?php

namespace Database\Seeders;

use App\Models\Permission;
use App\Models\PermissionAction;
use App\Models\PermissionSidebar;
use Illuminate\Database\Seeder;


class PermissionSeeder extends Seeder
{
    public function run(): void
    {


        $permissions = [

            [
                'name' => 'Guru',
                'description' => 'Hak akses Guru',
                'is_active' => true,
            ],

            [
                'name' => 'Staff',
                'description' => 'Hak akses Staff',
                'is_active' => true,
            ],

            [
                'name' => 'Operator',
                'description' => 'Hak akses Operator',
                'is_active' => true,
            ],

        ];



        $sidebars = [

            'Dashboard',
            'Manajemen Admin User',
            'Manajemen User',
            'Template Survei',
            'Backup Data',
            'Restore Data',
            'Data Survei',
            'Pertanyaan Survei',
            'Respon Survei',
            'Hak Akses',
            'Laporan',
            'Pengaturan',

        ];



        $menus = [

            'Manajemen Admin User',
            'Manajemen User',
            'Template Survei',
            'Data Survei',
            'Pertanyaan Survei',
            'Respon Survei',
            'Hak Akses',
            'Laporan',
            'Pengaturan',

        ];




        foreach ($permissions as $item) {


            $permission = Permission::firstOrCreate(

                [
                    'name' => $item['name'],
                ],

                [
                    'description' => $item['description'],
                    'is_active' => $item['is_active'],
                ]

            );



            foreach ($sidebars as $sidebar) {


                PermissionSidebar::firstOrCreate(

                    [
                        'permission_id' => $permission->id,
                        'sidebar_name' => $sidebar,
                    ],

                    [
                        'is_allowed' => true,
                    ]

                );
            }




            foreach ($menus as $menu) {


                PermissionAction::firstOrCreate(

                    [
                        'permission_id' => $permission->id,
                        'menu_name' => $menu,
                    ],

                    [
                        'can_view' => true,
                        'can_create' => true,
                        'can_edit' => true,
                        'can_delete' => true,
                    ]

                );
            }
        }
    }
}
