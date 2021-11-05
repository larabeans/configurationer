<?php

namespace App\Containers\Vendor\Configurationer\Providers;

use App\Containers\Vendor\Configurationer\Listeners\CreateTenantConfigurationListerner;

use App\Containers\Vendor\Tenanter\Events\TenantRegisteredEvent;
use App\Ship\Parents\Providers\MainProvider;
use Illuminate\Support\Facades\Event;

/**
 * The Main Service Provider of this container, it will be automatically registered in the framework.
 */
class MainServiceProvider extends MainProvider
{
    /**
     * Container Service Providers.
     */
    public array $serviceProviders = [
        // InternalServiceProviderExample::class,
    ];

    protected $listen = [

    ];


    /**
     * Container Aliases
     */
    public array $aliases = [
        // 'Foo' => Bar::class,
    ];

    /**
     * Register anything in the container.
     */
    public function register(): void
    {
        parent::register();

        // $this->app->bind(UserRepositoryInterface::class, UserRepository::class);
        // ...
    }
    public function boot(): void
    {
        parent::boot();

        Event::listen(
            TenantRegisteredEvent::class,
            [CreateTenantConfigurationListerner::class, 'handle']
        );

    }
}
