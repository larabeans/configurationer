<?php

namespace App\Containers\Larabeans\Configurationer\Listeners;

use App\Containers\Larabeans\Beaner\Events\UserCreated;
use App\Containers\Larabeans\Configurationer\Tasks\CreateConfigurationTask;

class CreateUserConfiguration
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     *
     * @param \App\Containers\Larabeans\Beaner\Events\UserCreated $event
     * @return void
     */
    public function handle(UserCreated $event)
    {
        app(CreateConfigurationTask::class)->run([
            'configurable_type' => 'user',
            'configuration' => configurationer()::getDefault('user'),
            'id' => $event->user->id
        ]);
    }
}
