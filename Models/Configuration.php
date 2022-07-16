<?php

namespace App\Containers\Larabeans\Configurationer\Models;

use App\Containers\Larabeans\Core\Parents\Models\Model;
use App\Containers\Larabeans\Configurationer\Models\ConfigurationHistory;

class Configuration extends Model
{
    protected $fillable = [
        'configuration',
        'configurable_type',
        'configurable_id',
        'tenant_id'
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

    public function configurationHistory()
    {
        return $this->hasMany(ConfigurationHistory::class);
    }

    public function configurable()
    {
        return $this->morphTo();
    }
}
