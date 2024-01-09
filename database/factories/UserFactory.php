<?php

namespace Database\Factories;

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\User>
 */
class UserFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition()
    {

        $password = "password";
        $hashs = ['sha1', 'sha256', 'md5'];
        $randomHash = $hashs[array_rand($hashs)];

         switch ($randomHash) {
            case 'sha1':
                $hashedPassword = sha1($password);
                break;
            case 'sha256':
                $hashedPassword = hash('sha256', $password);
                break;
            case 'md5':
                $hashedPassword = md5($password);
                break;
            default:
                $hashedPassword = Hash::make($password); // Bcrypt par défaut
                break;
        }

        return [
            'name' => fake()->name(),
            'email' => fake()->unique()->safeEmail(),
            'email_verified_at' => now(),
            'password' => $hashedPassword,
            'hash_used' => $randomHash, 
            'remember_token' => Str::random(10),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return static
     */
    public function unverified()
    {
        return $this->state(fn (array $attributes) => [
            'email_verified_at' => null,
        ]);
    }
}
