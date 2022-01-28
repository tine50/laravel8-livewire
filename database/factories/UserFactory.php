<?php

namespace Database\Factories;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class UserFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = User::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'nom' => $this->faker->lastName,
            'prenom' => $this->faker->firstName,
            'sexe' => array_rand(array_flip(["H", "F"]), 1),
            'email' => $this->faker->unique()->safeEmail(),
            'telephone1' => $this->faker->regexify('76[0-9]{7}'),
            'telephone2' => $this->faker->regexify('77[0-9]{7}'),
            'pieceIdentite' => array_rand(array_flip(['CNI', 'PASSPORT', 'PERMIS DE CONDUIRE']), 1),
            'numeroPieceIdentite' => $this->faker->unique()->bankAccountNumber,
            'photo' => $this->faker->imageUrl(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ];
    }
}
