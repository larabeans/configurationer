<?php

namespace App\Containers\Vendor\Configurationer\Traits;

use App\Containers\Vendor\Configurationer\Models\Configuration;

trait HasConfiguration
{
    public function configuration()
    {
        return $this->morphOne(Configuration::class,'configurable')->orderBy('created_at', 'desc');
    }

}
