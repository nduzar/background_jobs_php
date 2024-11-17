<?php

namespace App\Console\Commands;

use App\BackgroundJobs\BackgroundJobRunner;
use Illuminate\Console\Command;

class RunBackgroundJob extends Command
{
    protected $signature = 'background:run {class} {method} {params?}';
    protected $description = 'Run a background job';

    public function handle()
    {
        $class = $this->argument('class');
        $method = $this->argument('method');
        $params = json_decode($this->argument('params') ?? '[]', true);

        BackgroundJobRunner::run($class, $method, $params);
    }
}