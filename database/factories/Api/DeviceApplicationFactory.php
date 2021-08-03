<?php

namespace Database\Factories\Api;

use App\Models\Api\DeviceApplication;
use Illuminate\Database\Eloquent\Factories\Factory;

class DeviceApplicationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = DeviceApplication::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'device_id' => 1,
            'app_id' => 1,
        ];
    }
}
