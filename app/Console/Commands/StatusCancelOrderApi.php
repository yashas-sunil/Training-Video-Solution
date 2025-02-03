<?php

namespace App\Console\Commands;

use App\Http\Controllers\OrderController;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class StatusCancelOrderApi extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'statuscancelorderapi:cron';
    
    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
       
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(OrderController $orderController)
    {
        $orderController->statusCancelOrderApi();
  
    }
}
