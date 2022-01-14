<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('permissions')->insert([
            ['nom' => 'Ajouter une client'],
            ['nom' => 'Consulter un client'],
            ['nom' => 'Editer un client'],

            ['nom' => 'Ajouter une location'],
            ['nom' => 'Consulter une location'],
            ['nom' => 'Editer une location'],

            ['nom' => 'Ajouter un article'],
            ['nom' => 'Consulter un article'],
            ['nom' => 'Editer un article'],
        ]);
    }
}
