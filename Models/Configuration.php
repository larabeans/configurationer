<?php

namespace App\Containers\Vendor\Configurationer\Models;

use App\Containers\Vendor\Beaner\Parents\Models\Model;

class Configuration extends Model
{
    protected $fillable = [
        'configuration',
        'configable_type',
        'configable_id'

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
