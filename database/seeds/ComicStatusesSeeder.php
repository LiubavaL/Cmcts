<?php

use Illuminate\Database\Seeder;
use App\Models\ComicStatus;

class ComicStatusesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('comic_statuses')->delete();

        $comicStatus = ComicStatus::create([
            'title' => 'выпускается',
        ]);
        $comicStatus = ComicStatus::create([
            'title' => 'заморожен',
        ]);
        $comicStatus = ComicStatus::create([
            'title' => 'завершен',
        ]);
    }
}
