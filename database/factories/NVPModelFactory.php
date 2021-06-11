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
     * Define the model's default state.w
     *
     * @return array
     */
    public function definition()
    {
        $fakeISODate = $this->faker->iso8601();

        return [
            'key' => $this->faker->word(),
            'value' => $this->faker->word(),
            'timestamp' => strtotime($fakeISODate)
        ];
    }
}
