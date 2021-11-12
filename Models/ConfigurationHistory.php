<?php

namespace App\Containers\Vendor\Configurationer\Models;

use App\Containers\Vendor\Beaner\Parents\Models\Model;
use App\Containers\Vendor\Configurationer\Models\Configuration;

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
