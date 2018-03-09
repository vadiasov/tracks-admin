<?php

namespace Vadiasov\TracksAdmin\Commands;

use Illuminate\Console\Command;

class TracksAdminCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'tracks-admin:info';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Shows the tracks-admin package information';

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
     * @return mixed
     */
    public function handle()
    {
        $this->line('Package created using Bootpack.');
    }
}
