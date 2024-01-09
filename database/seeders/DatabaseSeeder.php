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

        for($i = 1; $i <= 10; $i++) {

            $name = 'Test ' . $i . ' User';
            $email = 'test' . $i . '@example.com';

            \App\Models\User::factory()->create([
                'name' => $name,
                'email' => $email,
            ]);
        }
    }
}
