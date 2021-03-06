<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call(RoleSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(ComicStatusesSeeder::class);
        $this->call(GenreSeeder::class);
        $this->call(CountriesSeeder::class);
        $this->call(LikeTypeSeeder::class);
    }
}
