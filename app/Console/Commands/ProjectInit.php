<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class ProjectInit extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:init';

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
    public function handle()
    {
        try {
            $this->call('cache:clear');
            $this->call('cache:clear');
            $this->call('migrate:fresh');
            $this->call('db:seed');
            print_r(PHP_EOL.'Setup project thành công');
            print_r(PHP_EOL.'Dùng lệnh: "php artisan ser" để chạy project');
        } catch (\Throwable $th) {
            throw $th;
        }
    }
}
