<?php

namespace App\Containers\Larabeans\Configurationer\Models;

use App\Containers\Larabeans\Beaner\Parents\Models\Model;
use App\Containers\Larabeans\Configurationer\Models\Configuration;

class ConfigurationHistory extends Model
{
    protected $table = "configuration_histories";
    protected $fillable = [
        'configuration_id',
        'configuration'
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
    protected string $resourceKey = 'ConfigurationHistory';

    public function Configuration()
    {
        return $this->belongsTo(Configuration::class, "configuration_id");
    }
}
