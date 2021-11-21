<?php

namespace App\Containers\Vendor\Configurationer\Listeners;

use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationTask;
use App\Containers\Vendor\Tenanter\Events\TenantRegisteredEvent;

class TenantRegsiteredEventListener
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param \App\Events\OrderShipped $event
     * @return void
     */
    public function handle(TenantRegisteredEvent $event)
    {
        // Access the tenant using $event->entity
        app(CreateConfigurationTask::class)->run([
            'configurable_type' => 'tenant',
            'configuration' => config('configuration.default'),
            'tenant_id' => $event->entity->id
        ]);
    }
}
