<?php

namespace App\Containers\Vendor\Configurationer\Providers;

use App\Ship\Parents\Providers\MainProvider;
use App\Containers\Vendor\Configurationer\Configurationer;

class ConfigurationServiceProvider extends MainProvider
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
