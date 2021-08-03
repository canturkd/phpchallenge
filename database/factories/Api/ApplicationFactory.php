<?php

namespace Database\Factories\Api;

use App\Enums\ApplicationPeriodEnum;
use App\Models\Api\Application;
use Illuminate\Database\Eloquent\Factories\Factory;

class ApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Application::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $price = [100, 200, 300];
        $type = rand(1,3);

        return [
            'name' => $this->faker->name,
            'type' => ApplicationPeriodEnum::label(rand(1,3)),
            'price' => $price[$type-1],
        ];
    }
}
