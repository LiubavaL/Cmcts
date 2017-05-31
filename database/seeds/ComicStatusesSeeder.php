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
            'title' => 'Ongoing',
        ]);
        $comicStatus = ComicStatus::create([
            'title' => 'Frozen',
        ]);
        $comicStatus = ComicStatus::create([
            'title' => 'Finished',
        ]);
    }
}
