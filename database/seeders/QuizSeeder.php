<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Lms\Entities\Quiz;
use Modules\Master\Entities\School;

class QuizSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = $this->command->ask(
            'How many quizzes you want to create, for 1 course?',
            3
        );

        School::all()->map(function (School $school) use ($count) {
            Quiz::factory((int) $count)->create([
                'school_id' => $school->id
            ]);
        });
    }
}