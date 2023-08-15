<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('courses')->delete();
        $data = [
            // ['course_name' => 'Toeic', 'description' => 'Practise Toeic Test', 'major_id' => '1'],
            
            [
                'course_name' => 'English Basic', 
                'description' => 'English Basic Course', 
                'major_id' => '1',
                
            ],
            [
                'course_name' => 'English Advanced', 
                'description' => 'English Advanced Course', 
                'major_id' => '1',
                
            ],
            [
                'course_name' => 'Ielts', 
                'description' => 'Practise Ielts Exam Course', 
                'major_id' => '1',
                
            ],
            [
                'course_name' => 'Toeic', 
                'description' => 'Practise Toeic Exam Course', 
                'major_id' => '1',    
            ],
            [
                'course_name' => 'PTE', 
                'description' => 'Practise Toeic Exam Course', 
                'major_id' => '1',    
            ],
            [
                'course_name' => 'Korean Basic', 
                'description' => 'Korean Basic Course', 
                'major_id' => '2',    
            ],
            [
                'course_name' => 'Korean Advanced', 
                'description' => 'Korean Advanced Course', 
                'major_id' => '2',    
            ],
            [
                'course_name' => 'TOPIK', 
                'description' => 'Practise TOPIK Exam Course', 
                'major_id' => '2',    
            ],
            [
                'course_name' => 'KLAT II', 
                'description' => 'Practise KLAT II Exam Course', 
                'major_id' => '2',    
            ],
            [
                'course_name' => 'KLAT III', 
                'description' => 'Practise KLAT III Exam Course', 
                'major_id' => '2',    
            ],
            [
                'course_name' => 'Japanese Basic', 
                'description' => 'Japanese Basic Course', 
                'major_id' => '3',
                
            ],
            [
                'course_name' => 'Japanese Advanced', 
                'description' => 'Japanese Advanced Course', 
                'major_id' => '3',  
            ],
            [
                'course_name' => 'JLPT N1', 
                'description' => 'Practise N1 Exam Course', 
                'major_id' => '3',    
            ],
            [
                'course_name' => 'JLPT N2', 
                'description' => 'Practise N2 Exam Course', 
                'major_id' => '3',    
            ],
            [
                'course_name' => 'JLPT N3', 
                'description' => 'Practise N3 Exam Course', 
                'major_id' => '3',    
            ],
            
        ];
        DB::table('courses')->insert($data);
    }
}
