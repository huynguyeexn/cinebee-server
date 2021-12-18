<?php

namespace App\Console\Commands;

use App\Models\Order;
use Carbon\Carbon;
use Illuminate\Console\Command;
use DB;

class RemovePendingOrderCron extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'RemovePendingOrder:cron';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Remove Pending Order';

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
    public function handle()
    {
        try {
            Order::where('status', '=', 1)
                ->where('created_at', '<', Carbon::now()->subDays(1))
                ->delete();
            $result = Order::where('status', '=', 1)->get();
            $this->info($result);
            $this->info('RemovePendingOrder:cron Command Run successfully!');
        } catch (\Exception $e) {
            $this->error('RemovePendingOrder:cron Command Error!');
            $this->error($e->getMessage());
        }
    }
}
