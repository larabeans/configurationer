<?php

namespace App\Containers\Vendor\Configurationer\Providers;

use App\Containers\Vendor\Beaner\Events\UserCreated;
use App\Containers\Vendor\Configurationer\Listeners\CreateUserConfiguration;
use App\Containers\Vendor\Configurationer\Listeners;
use App\Ship\Parents\Providers\EventsProvider;

class EventsServiceProvider extends EventsProvider
{
    /**
     * The event listener mappings for the application.
     *
     *
     * @var array
     */
    protected $listen = [
      UserCreated::class =>[
          Listeners\CreateUserConfiguration::class
      ]
    ];


    public function register()
    {
        parent::register();
    }

    public function boot(): void
    {
        parent::boot();
    }
}
