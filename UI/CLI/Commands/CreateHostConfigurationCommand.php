<?php

namespace App\Containers\Vendor\Configurationer\UI\CLI\Commands;


use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationTask;
use App\Containers\Vendor\Configurationer\Tasks\GetConfigurationTask;
use Illuminate\Console\Command;

class CreateHostConfigurationCommand extends Command
{
    protected $description = 'Generate host configuration';

    protected $name = 'larabeans:host:configuration';

    public function handle()
    {
        $configuration = app(GetConfigurationTask::class)->run("host");
        if (!empty($configuration)) {
            $this->line("<fg=red>" . "Configuration already exist.");
        } else {
            empty(app(CreateConfigurationTask::class)->run(['configurable_type' => 'host', 'configuration' => []])) ?: $this->line("<fg=green>" . "Configuration created sucessfully");
        }
    }
}
