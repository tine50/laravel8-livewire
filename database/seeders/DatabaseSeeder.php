<?php

namespace Database\Seeders;

use App\Models\Client;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Database\Seeders\RoleTableSeeder;
use Database\Seeders\PermissionTableSeeder;
use Database\Seeders\TypeArticleTableSeeder;
use Database\Seeders\DureeLocationTableSeeder;
use Database\Seeders\StatutLocationTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call(TypeArticleTableSeeder::class);
        $this->call(StatutLocationTableSeeder::class);
        $this->call(RoleTableSeeder::class);
        $this->call(PermissionTableSeeder::class);
        $this->call(DureeLocationTableSeeder::class);
        Client::factory(100)->create();
        Article::factory(100)->create();
    }
}
