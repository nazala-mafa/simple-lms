<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Lms\Entities\Course;
use Modules\Master\Entities\School;

class CourseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $count = $this->command->ask(
            'How many courses you want to create, for 1 school?',
            3
        );

        School::all()->map(function (School $school) use ($count) {
            Course::factory((int) $count)->create([
                'school_id' => $school->id
            ]);
        });
    }
}