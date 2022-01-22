<?php

namespace App\Containers\Vendor\Configurationer\Listeners;

use App\Containers\Vendor\Beaner\Events\UserCreated;
use App\Containers\Vendor\Tenanter\Tasks\CreateConfigurationTask;

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
     * @param \App\Containers\Vendor\Beaner\Events\UserCreated $event
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
