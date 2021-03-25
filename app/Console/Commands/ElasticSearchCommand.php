<?php

namespace App\Console\Commands;
use Illuminate\Console\Command;

class ElasticSearchCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'elastic:handle';

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

    public function handle()
    {
        foreach (config('models') as $models) {
            foreach ($models as $model) {
                $this->call("scout:import", ['model' => $model]);
            }
        }
    }
}
