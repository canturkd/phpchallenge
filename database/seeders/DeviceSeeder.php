<?php

namespace Database\Seeders;

use App\Models\Api\Device;
use Illuminate\Database\Seeder;

class DeviceSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        for ($i =0; $i<10; $i++) {
            Device::factory()->create();
        }
    }
}
