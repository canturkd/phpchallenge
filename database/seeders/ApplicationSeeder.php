<?php

namespace Database\Seeders;

use App\Models\Api\Application;
use Illuminate\Database\Seeder;
use Illuminate\Foundation\Testing\WithFaker;

class ApplicationSeeder extends Seeder
{
    use WithFaker;
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Application::factory()->create([
            'type' => 'yearly'
        ]);
        Application::factory()->create([
            'type' => 'monthly'
        ]);
    }
}
