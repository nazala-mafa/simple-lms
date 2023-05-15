<?php

namespace Modules\Lms\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class CourseFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Lms\Entities\Course::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => 1,
            'title' => fake()->sentence(),
            'description' => fake()->sentence(12),
            'is_published' => 1
        ];
    }
}