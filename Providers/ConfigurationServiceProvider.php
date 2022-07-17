<?php

namespace App\Containers\Larabeans\Configurationer\Providers;

use App\Ship\Parents\Providers\MainServiceProvider as ParentMainServiceProvider;
use App\Containers\Larabeans\Configurationer\Configurationer;

class ConfigurationServiceProvider extends ParentMainServiceProvider
{

    public function register():void
    {
        parent::register();

        // Stateful Bootstrappers ( i.e. singletons)
        $this->app->singleton(Configurationer::class);

    }

    public function boot() : void
    {
        parent::boot();
    }

}
