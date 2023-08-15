<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MajorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $department_id = DB::table('departments')->where('name', '=', 'Foreign Language')->get('id');
        DB::table('majors')->delete();

        $data = [
            [
                'major_name' => 'English', 
                'description' => 'English',
            ],
            [
                'major_name' => 'Korean', 
                'description' => 'Korean',
            ],
            [
                'major_name' => 'Japanese', 
                'description' => 'Japanese',
            ],
   
        ];

        DB::table('majors')->insert($data);
    }
}
