<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Profile;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AdminSeeder::class);
        // Create 10 users
        User::factory(10)->create();
        // Create fake profiles for each user
        User::all()->each(function ($user) {
            $profile = Profile::factory()->for($user)->create();
        });
    }
}
