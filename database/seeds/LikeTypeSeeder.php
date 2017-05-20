<?php

use Illuminate\Database\Seeder;
use App\Models\LikeType;

class LikeTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        LikeType::create([
            'name'=> 'awesome'
        ]);

        LikeType::create([
            'name'=> 'wondering'
        ]);

        LikeType::create([
            'name'=> 'bad'
        ]);
    }
}
