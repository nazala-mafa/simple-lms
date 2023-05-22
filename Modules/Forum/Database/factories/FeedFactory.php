<?php

namespace Modules\Forum\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FeedFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Forum\Entities\Feed::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'caption' => fake()->sentence(),
        ];
    }
}