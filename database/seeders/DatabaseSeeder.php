<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Client;
use App\Models\Article;
use Illuminate\Database\Seeder;
use Database\Seeders\UserSeeder;
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

        Client::factory(10)->create();
        User::factory(10)->create();
        Article::factory(10)->create();

        User::find(1)->roles()->attach(1);
        User::find(2)->roles()->attach(2);
        User::find(3)->roles()->attach(3);
        User::find(4)->roles()->attach(4);

        User::find(1)->permissions()->attach(1);
        User::find(1)->permissions()->attach(2);
        User::find(1)->permissions()->attach(6);
        User::find(2)->permissions()->attach(3);
        User::find(2)->permissions()->attach(2);
        User::find(2)->permissions()->attach(4);

        $this->call(UserSeeder::class);
    }
}
