<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
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
        // \App\Models\User::factory(10)->create();

        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test 2 User',
            'email' => 'test2@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test 3 User',
            'email' => 'test3@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test 4 User',
            'email' => 'test4@example.com',
        ]);

        \App\Models\User::factory()->create([
            'name' => 'Test 5 User',
            'email' => 'test5@example.com',
        ]);
    }
}
