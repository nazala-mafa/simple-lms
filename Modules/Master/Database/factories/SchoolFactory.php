<?php

namespace Modules\Master\Database\factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class SchoolFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = \Modules\Master\Entities\School::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $num = fake()->numberBetween(1, 100);
        return [
            'name' => "SMA $num Jakarta Selatan",
            'slug' => "sma-$num-jakarta-selatan",
            'email' => "sma${num}jaksel@gmail.com",
            'address' => fake()->address(),
            'status_id' => 1,
        ];
    }
}