<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\UserAdmin>
 */
class UserAdminFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'username' => 'root',
            'type' => 'admin',
            'email' => 'root@email.com',
            'password' => bcrypt('123456'),
            'status' => 'active',
        ];
    }
}
