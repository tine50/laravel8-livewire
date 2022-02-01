<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class UserPermissionFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => rand(1, 10),
            'permission_id' => rand(1, 9)
        ];
    }
}
