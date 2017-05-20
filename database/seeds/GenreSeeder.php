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
            'title' => 'artbook',
        ]);

        $genre = Genre::create([
            'title' => 'comedy',
        ]);
        
        $genre = Genre::create([
            'title' => 'drama',
        ]);
        
        $genre = Genre::create([
            'title' => 'fantasy',
        ]);
        
        $genre = Genre::create([
            'title' => 'harem',
        ]);
        
        $genre = Genre::create([
            'title' => 'horror',
        ]);
        
        $genre = Genre::create([
            'title' => 'mecha',
        ]);
        
        $genre = Genre::create([
            'title' => 'romance',
        ]);
        
        $genre = Genre::create([
            'title' => 'sci-fi',
        ]);
        
        $genre = Genre::create([
            'title' => 'shoujo',
        ]);
        
        $genre = Genre::create([
            'title' => 'shounen',
        ]);
        
        $genre = Genre::create([
            'title' => 'slice of life',
        ]);
        
        $genre = Genre::create([
            'title' => 'sports',
        ]);
        
        $genre = Genre::create([
            'title' => 'tragedy',
        ]);
        
        $genre = Genre::create([
            'title' => 'yaoi',
        ]);
        
        $genre = Genre::create([
            'title' => 'action',
        ]);
        
        $genre = Genre::create([
            'title' => 'adventire',
        ]);
        
        $genre = Genre::create([
            'title' => 'doujinshi',
        ]);
        
        $genre = Genre::create([
            'title' => 'ecchi',
        ]);
        
        $genre = Genre::create([
            'title' => 'gender bender',
        ]);
        
        $genre = Genre::create([
            'title' => 'historical',
        ]);
        
        $genre = Genre::create([
            'title' => 'josei',
        ]);
        
        $genre = Genre::create([
            'title' => 'mystery',
        ]);
        
        $genre = Genre::create([
            'title' => 'psychological',
        ]);
        
        $genre = Genre::create([
            'title' => 'school life',
        ]);

        $genre = Genre::create([
            'title' => 'seinen',
        ]);

        $genre = Genre::create([
            'title' => 'shoujo-ai',
        ]);

        $genre = Genre::create([
            'title' => 'shounen-ai',
        ]);

        $genre = Genre::create([
            'title' => 'supernatural',
        ]);

        $genre = Genre::create([
            'title' => 'yuri',
        ]);

        $genre = Genre::create([
            'title' => 'трагедия',
        ]);

        $genre = Genre::create([
            'title' => 'триллер',
        ]);

        $genre = Genre::create([
            'title' => 'ужасы',
        ]);
    }
}
