<?php

namespace Database\Seeders;

use App\Models\Country;
use App\Models\Course;
use App\Models\Specialization;
use App\Models\User;
use Faker\Factory as FakerFactory;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CourseSeeder extends Seeder
{
    public function run()
    {
        DB::table('courses')->truncate();

        // Use a loop to generate 90 more courses
        for ($i = 0; $i < 90; $i++) {
            $statuses = ['pending', 'accepted'];
            $course = [
                'name' => fake()->name,
                'specialization_id' => rand(1, 10),
                'teacher_id' => rand(1, 10),
                'description' => substr(fake()->paragraph(3), 0, 100),
                'status' => $statuses[random_int(0, 1)],
                'country_id' => rand(1, 10),
                'created_at' => now(),
                'updated_at' => now(),
            ];
            DB::table('courses')->insert($course);
        }
    }
}
