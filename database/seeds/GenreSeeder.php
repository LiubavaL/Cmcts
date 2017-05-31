<?php

use Illuminate\Database\Seeder;
use App\Models\Genre;

class GenreSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('genres')->delete();

        $genre = Genre::create([
            'title' => 'Artbook',
        ]);

        $genre = Genre::create([
            'title' => 'Comedy',
        ]);
        
        $genre = Genre::create([
            'title' => 'Drama',
        ]);
        
        $genre = Genre::create([
            'title' => 'Fantasy',
        ]);
        
        $genre = Genre::create([
            'title' => 'Harem',
        ]);
        
        $genre = Genre::create([
            'title' => 'Horror',
        ]);
        
        $genre = Genre::create([
            'title' => 'Mecha',
        ]);
        
        $genre = Genre::create([
            'title' => 'Romance',
        ]);
        
        $genre = Genre::create([
            'title' => 'Sci-fi',
        ]);
        
        $genre = Genre::create([
            'title' => 'Shoujo',
        ]);
        
        $genre = Genre::create([
            'title' => 'Shounen',
        ]);
        
        $genre = Genre::create([
            'title' => 'Slice of Life',
        ]);
        
        $genre = Genre::create([
            'title' => 'Sports',
        ]);
        
        $genre = Genre::create([
            'title' => 'Tragedy',
        ]);
        
        $genre = Genre::create([
            'title' => 'Yaoi',
        ]);
        
        $genre = Genre::create([
            'title' => 'Action',
        ]);
        
        $genre = Genre::create([
            'title' => 'Adventire',
        ]);
        
        $genre = Genre::create([
            'title' => 'Doujinshi',
        ]);
        
        $genre = Genre::create([
            'title' => 'Ecchi',
        ]);
        
        $genre = Genre::create([
            'title' => 'Gender bender',
        ]);
        
        $genre = Genre::create([
            'title' => 'Historical',
        ]);
        
        $genre = Genre::create([
            'title' => 'Josei',
        ]);
        
        $genre = Genre::create([
            'title' => 'Mystery',
        ]);
        
        $genre = Genre::create([
            'title' => 'Psychological',
        ]);
        
        $genre = Genre::create([
            'title' => 'School life',
        ]);

        $genre = Genre::create([
            'title' => 'Seinen',
        ]);

        $genre = Genre::create([
            'title' => 'Shoujo-ai',
        ]);

        $genre = Genre::create([
            'title' => 'Shounen-ai',
        ]);

        $genre = Genre::create([
            'title' => 'Supernatural',
        ]);

        $genre = Genre::create([
            'title' => 'Yuri',
        ]);

        $genre = Genre::create([
            'title' => 'Tragedy',
        ]);

        $genre = Genre::create([
            'title' => 'Thriller',
        ]);

        $genre = Genre::create([
            'title' => 'Horror',
        ]);
    }
}
