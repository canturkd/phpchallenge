<?php

namespace Database\Seeders;

use App\Models\Api\Device;
use App\Models\Api\DeviceApplication;
use Illuminate\Database\Seeder;

class DeviceApplicationSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // 1 -yearly 2- monthly

        $devices = Device::all();;

        $startDate = now();
        $endDateMonthly = now()->addMonth();
        $endDateYearly = now()->addYear();

        foreach ($devices as $device) {

            $appId = rand(1,300)%2 + 1;
            DeviceApplication::factory()->create([
                'device_id' => $device->id,
                'app_id' => $appId,
                'start_date' => $startDate,
                'end_date' => ($appId == 1) ? $endDateYearly : $endDateMonthly
            ]);
        }
    }
}
