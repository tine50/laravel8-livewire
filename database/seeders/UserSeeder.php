<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();
        User::create([
            'nom' => 'TINE',
            'prenom' => 'Abdoussalam',
            'sexe' => array_rand(array_flip(["H", "F"]), 1),
            'email' => 'abdoussalamtine4@gmail.com',
            'telephone1' => $faker->regexify('76[0-9]{7}'),
            'telephone2' => $faker->regexify('77[0-9]{7}'),
            'pieceIdentite' => array_rand(array_flip(['CNI', 'PASSPORT', 'PERMIS DE CONDUIRE']), 1),
            'numeroPieceIdentite' => $faker->unique()->bankAccountNumber,
            'photo' => $faker->imageUrl(),
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        ])->roles()->attach(2);
    }
}
