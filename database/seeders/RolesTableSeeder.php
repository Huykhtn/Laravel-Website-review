<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('roles')->delete();

        $roles = [
            [
                'role_id'    => 1,
                'title' => 'Admin',
            ],
            [
                'role_id'    => 2,
                'title' => 'Teacher',
            ],
            [
                'id'    => 3,
                'title' => 'Student',
            ],
        ];

        DB::table('roles')->insert($roles);
    }
}
