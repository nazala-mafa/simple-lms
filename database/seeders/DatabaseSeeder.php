<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->callOnce([
            SchoolStatusSeeder::class,
            SchoolSeeder::class,
            RoleSeeder::class,
            UserSeeder::class,
            CourseSeeder::class,
            QuizSeeder::class,
            QuestionSeeder::class,
            AnswerSeeder::class,
            ModuleSeeder::class
        ]);
    }
}