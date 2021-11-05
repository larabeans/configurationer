<?php

namespace App\Containers\Vendor\Configurationer\Models;

use App\Containers\Vendor\Beaner\Parents\Models\Model;
use App\Containers\Vendor\Configurationer\Models\ConfigurationHistory;

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

    public function ConfigurationHistory(){
        return $this->hasMany(ConfigurationHistory::class);
    }
}
