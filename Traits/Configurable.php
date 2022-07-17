<?php

namespace App\Containers\Larabeans\Configurationer\Traits;

use App\Containers\Larabeans\Configurationer\Models\Configuration;

trait Configurable
{
    public function configuration()
    {
        return $this->morphOne(Configuration::class, 'configurable')->orderBy('created_at', 'desc');
    }
}
