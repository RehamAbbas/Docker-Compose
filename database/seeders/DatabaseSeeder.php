<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Content;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();
       // Course::factory(10)->create();

        $this->call([
            RoleAndPermissionSeeder::class,
            SpecializationSeeder::class,
             UserSeeder::class,
            CountrySeeder::class,
            CourseSeeder::class,
            ContentSeeder::class,

        ]);
    }
}
