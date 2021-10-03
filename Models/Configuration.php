<?php

namespace App\Containers\AppSection\Configurationer\Models;

use App\Containers\Vendor\Beaner\Parents\Models\Model;

class Configuration extends Model
{
    protected $fillable = [
        'configuration',
        'configurable_type',
        'configurable_id'

    ];

    protected $attributes = [

    ];

    protected $hidden = [

    ];

    protected $casts = [

    ];

    protected $dates = [
        'created_at',
        'updated_at',
    ];

    /**
     * A resource key to be used in the serialized responses.
     */
    protected string $resourceKey = 'Configuration';
}
