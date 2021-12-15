<?php

use App\Containers\Vendor\Configurationer\Configurationer;

if (! function_exists('configurationer')) {
    /** @return Tenancy */
    function configurationer()
    {
        return app(Configurationer::class);
    }
}
