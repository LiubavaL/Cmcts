<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\ConfirmUsers;
use App\Models\Comic;

class Kernel extends ConsoleKernel
{
    /**
     * The Artisan commands provided by your application.
     *
     * @var array
     */
    protected $commands = [
        //
    ];

    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        //delete expired confirmation tokens
        //and soft-deleted comics
         $schedule->call(function (){
            ConfirmUsers::where('updated_at', '<', date('Y-m-d H:i:s', strtotime('-1 hours')))->delete();

             $deletedComics = Comic::onlyTrashed()->get();
             $deletedComics->history()->forceDelete();
         })->everyMinute();
    }

    /**
     * Register the Closure based commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        require base_path('routes/console.php');
    }
}
