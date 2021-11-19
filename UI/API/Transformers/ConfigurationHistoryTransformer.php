<?php

namespace App\Containers\Vendor\Configurationer\UI\API\Transformers;

use App\Containers\Vendor\Configurationer\Models\ConfigurationHistory;
use App\Ship\Parents\Transformers\Transformer;

class ConfigurationHistoryTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected $availableIncludes = [

    ];

    public function transform(ConfigurationHistory $configurationhistory): array
    {
        $response = [
            'object' => $configurationhistory->getResourceKey(),
            //'id' => $configurationhistory->getHashedKey(),
            //'tenant_id' => $configurationhistory->tenant_id,
            //'configuration_id' => $configurationhistory->configuration_id,
            'configuration' => json_decode($configurationhistory->configuration),
            'created_at' => $configurationhistory->created_at,
            'updated_at' => $configurationhistory->updated_at,
            'readable_created_at' => $configurationhistory->created_at->diffForHumans(),
            'readable_updated_at' => $configurationhistory->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $configurationhistory->id,
            // 'deleted_at' => $configurationhistory->deleted_at,
        ], $response);

        return $response;
    }
}
