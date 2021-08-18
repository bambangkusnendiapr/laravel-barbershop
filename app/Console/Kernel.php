<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use App\Models\Order;
use Illuminate\Support\Facades\DB;

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
        // $schedule->command('inspire')->hourly();
        $schedule->call(function () {
            
            //ambil order yang status order
            $orders = Order::where('lunas', 'Order')->get();
            foreach($orders as $order) {
                if($order->date->addHour(24) < now()) {
                    $order->delete();
                    // DB::table('categories')->insert([
                    //     'name' => "delete order",
                    //     'created_at' => date("Y-m-d h:i:s")
                    // ]);
                }
            }

        })->everyMinute();

        // $schedule->call(function () {

        //     DB::table('categories')->insert([
        //         'name' => "1 menit",
        //         'created_at' => date("Y-m-d h:i:s")
        //     ]);
    
        // })->everyMinute();
    
        // $schedule->call(function () {
        //     DB::table('categories')->insert([
        //         'name' => "5 menit",
        //         'created_at' => date("Y-m-d h:i:s")
        //     ]);
    
        // })->everyFiveMinutes();
    }

    /**
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
