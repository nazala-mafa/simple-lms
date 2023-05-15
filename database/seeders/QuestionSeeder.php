<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Lms\Entities\Question;
use Modules\Lms\Entities\Quiz;

class QuestionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = $this->command->ask(
            'How many questions you want to create, for 1 quizzes?',
            3
        );

        Quiz::all()->map(function (Quiz $quiz) use ($count) {
            Question::factory((int) $count)->create([
                'quiz_id' => $quiz->id,
                'school_id' => $quiz->school_id
            ]);
        });
    }
}