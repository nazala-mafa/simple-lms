<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Modules\Lms\Entities\Answer;
use Modules\Lms\Entities\Question;

class AnswerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $count = $this->command->ask(
            'How many answers you want to create, for 1 question?',
            3
        );

        Question::all()->map(function (Question $question) use ($count) {
            Answer::create([
                'user_id' => 1,
                'quiz_id' => $question->quiz_id,
                'question_id' => $question->id,
                'answer' => 'true - ' . fake()->sentence(),
                'is_true' => 1
            ]);

            Answer::factory(((int) $count) - 1)->create([
                'quiz_id' => $question->quiz_id,
                'question_id' => $question->id,
                'is_true' => 0
            ]);
        });
    }
}