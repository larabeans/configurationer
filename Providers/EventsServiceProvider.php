<?php

namespace App\Containers\Larabeans\Configurationer\Providers;

use App\Containers\Larabeans\Core\Events\UserCreated;
use App\Containers\Larabeans\Configurationer\Listeners\CreateUserConfiguration;
use App\Containers\Larabeans\Configurationer\Listeners;
use App\Ship\Parents\Providers\EventServiceProvider;

class EventsServiceProvider extends EventServiceProvider
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
