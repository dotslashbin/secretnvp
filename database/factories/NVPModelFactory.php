<?php

namespace Database\Factories;

use App\Models\NVPModel;
use Illuminate\Database\Eloquent\Factories\Factory;

class NVPModelFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = NVPModel::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
            'created_at' => $this->faker->iso8601()
        ];
    }
}