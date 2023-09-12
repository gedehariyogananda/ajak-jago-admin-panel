<?php

namespace Database\Seeders;

use App\Models\Team;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\Team::factory()->create();
        // \App\Models\Team::factory()->customDefination()->create();
        // \App\Models\Team::factory()->customDefination2()->create();
        \App\Models\User::factory()->create();
        // \App\Models\User::factory()->customDefination()->create();
    }
}
