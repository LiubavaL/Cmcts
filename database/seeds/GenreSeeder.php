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
            'title' => 'артбук',
        ]);

        $genre = Genre::create([
            'title' => 'боевик',
        ]);
        
        $genre = Genre::create([
            'title' => 'боевые искусства',
        ]);
        
        $genre = Genre::create([
            'title' => 'вампиры',
        ]);
        
        $genre = Genre::create([
            'title' => 'гарем',
        ]);
        
        $genre = Genre::create([
            'title' => 'гендерная интрига',
        ]);
        
        $genre = Genre::create([
            'title' => 'фэнтези',
        ]);
        
        $genre = Genre::create([
            'title' => 'детектив',
        ]);
        
        $genre = Genre::create([
            'title' => 'дзёсэй',
        ]);
        
        $genre = Genre::create([
            'title' => 'додзинси',
        ]);
        
        $genre = Genre::create([
            'title' => 'драма',
        ]);
        
        $genre = Genre::create([
            'title' => 'история',
        ]);
        
        $genre = Genre::create([
            'title' => 'киберпанк',
        ]);
        
        $genre = Genre::create([
            'title' => 'комедия',
        ]);
        
        $genre = Genre::create([
            'title' => 'махо-сёдзё',
        ]);
        
        $genre = Genre::create([
            'title' => 'меха',
        ]);
        
        $genre = Genre::create([
            'title' => 'мистика',
        ]);
        
        $genre = Genre::create([
            'title' => 'научная фантастика',
        ]);
        
        $genre = Genre::create([
            'title' => 'повседневность',
        ]);
        
        $genre = Genre::create([
            'title' => 'постапокалиптика',
        ]);
        
        $genre = Genre::create([
            'title' => 'приключения',
        ]);
        
        $genre = Genre::create([
            'title' => 'психология',
        ]);
        
        $genre = Genre::create([
            'title' => 'романтика',
        ]);
        
        $genre = Genre::create([
            'title' => 'сёдзё',
        ]);
        
        $genre = Genre::create([
            'title' => 'сёдзё-ай',
        ]);

        $genre = Genre::create([
            'title' => 'юри',
        ]);

        $genre = Genre::create([
            'title' => 'сёнэн',
        ]);

        $genre = Genre::create([
            'title' => 'сёнэн-ай',
        ]);

        $genre = Genre::create([
            'title' => 'яой',
        ]);

        $genre = Genre::create([
            'title' => 'спорт',
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

        $genre = Genre::create([
            'title' => 'фантастика',
        ]);

        $genre = Genre::create([
            'title' => 'школа',
        ]);

        $genre = Genre::create([
            'title' => 'этти',
        ]);
    }
}
