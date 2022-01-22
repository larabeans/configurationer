<?php

namespace App\Containers\Vendor\Configurationer\Providers;

use App\Ship\Parents\Providers\MainProvider;
use App\Containers\Vendor\Configurationer\Providers\ConfigurationServiceProvider;

/**
 * Class MainServiceProvider.
 *
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     *
     * @var array
     */
    public $serviceProviders = [
        ConfigurationServiceProvider::class,
        EventsServiceProvider::class
    ];

    /**
     * Container Aliases
     *
     * @var  array
     */
    public $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();
    }

    /**
     * Register anything in the container.
     */
    public function boot(): void
    {
        parent::boot();
    }
}
