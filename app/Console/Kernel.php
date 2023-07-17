<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Infant;
use App\Models\InfantVaccine;
use App\Notifications\VaccineReminderNotification;


class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     *
     * @param  \Illuminate\Console\Scheduling\Schedule  $schedule
     * @return void
     */
    protected function schedule(Schedule $schedule)
    {
        // $schedule->command('inspire')->hourly();
        $schedule->command('vaccines:reminders')->everyMinute();


        // $schedule->call(function () {
        //     // Check for upcoming vaccine doses for infants
        //     $infants = Infant::all();

        //     foreach ($infants as $infant) {
        //         $vaccines = $infant->infantVaccines()->where('administration_date', '>=', now()->toDateString())->get();

        //         foreach ($vaccines as $vaccine) {
        //             $parents = $infant->parent;

        //             foreach ($parents as $parent) {
        //                 $parent->notify(new VaccineReminderNotification($infant, $vaccine));
        //             }
        //         }
        //     }
        // })->everyMinute(); // Run the task daily or set the desired schedule


    }

    /**    public function everyMinute()

     * Register the commands for the application.
     *
     * @return void
     */
    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
