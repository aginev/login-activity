<?php

namespace Aginev\LoginActivity\Commands;

use Illuminate\Console\Command;
use Aginev\LoginActivity\LoginActivityFacade;

class LoginActivityClean extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'login-activity:clean {days?}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Clean older login activity logs';

    /**
     * Create a new command instance.
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $days = (int)$this->argument('days');
        $days = $days ?: 30;

        LoginActivityFacade::cleanLog($days);

        $this->info('Older login activity logs cleaned!');
    }
}
