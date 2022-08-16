<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Course;
class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $course_1 = [
            'course_code' => 'A101',
            'course_title' => 'Introduction to computer',
            'credit_hours' => '3',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        $course_2 = [
            'course_code' => 'A102',
            'course_title' => 'Programming Fundamentals',
            'credit_hours' => '2',
            'created_at' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s'),
        ];

        Course::upsert(
            [$course_1, $course_2],
            ['course_code'],
            ['course_code', 'course_title', 'credit_hours'],
        );
    }
}
