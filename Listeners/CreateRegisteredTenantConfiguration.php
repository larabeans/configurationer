<?php

namespace App\Containers\Vendor\Configurationer\Listeners;

use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationTask;
use App\Containers\Vendor\Tenanter\Events\TenantRegistered;

class CreateRegisteredTenantConfiguration
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
    public function handle(TenantRegistered $event)
    {
        // Access the tenant using $event->entity
        app(CreateConfigurationTask::class)->run([
            'configurable_type' => 'tenant',
            'configuration' => config('configurationer.default'),
            'tenant_id' => $event->entity->id
        ]);
    }
}
