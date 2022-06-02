<?php

namespace App\Containers\Vendor\Configurationer\UI\API\Transformers;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Ship\Parents\Transformers\Transformer;

class ConfigurationTransformer extends Transformer
{
    /**
     * @var  array
     */
    protected array $defaultIncludes = [

    ];

    /**
     * @var  array
     */
    protected array $availableIncludes = [

    ];

    public function transform(Configuration $configuration): array
    {
        $response = [
            'object' => $configuration->getResourceKey(),
            'id' => $configuration->getHashedKey(),
            'configuration' => $configuration->configuration,
            'created_at' => $configuration->created_at,
            'updated_at' => $configuration->updated_at,
            'readable_created_at' => $configuration->created_at->diffForHumans(),
            'readable_updated_at' => $configuration->updated_at->diffForHumans(),
        ];

        $response = $this->ifAdmin([
            //'real_id' => $configuration->id,
            // 'deleted_at' => $configuration->deleted_at,
        ], $response);

        return $response;
    }
}
