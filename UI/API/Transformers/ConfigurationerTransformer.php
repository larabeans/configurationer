<?php

namespace App\Containers\Vendor\Configurationer\UI\API\Transformers;

use App\Containers\Vendor\Configurationer\Models\Configuration;
use App\Ship\Parents\Transformers\Transformer;

class ConfigurationerTransformer extends Transformer
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

    public function transform(Configuration $configurationer): array
    {
        $response = [
            'object' => $configurationer->getResourceKey(),
            'id' => $configurationer->getHashedKey(),
            'configuration'=>$configurationer->configuration,
            'created_at' => $configurationer->created_at,
            'updated_at' => $configurationer->updated_at,
            'readable_created_at' => $configurationer->created_at->diffForHumans(),
            'readable_updated_at' => $configurationer->updated_at->diffForHumans(),

        ];

        $response = $this->ifAdmin([
            'real_id'    => $configurationer->id,
            // 'deleted_at' => $configurationer->deleted_at,
        ], $response);

        return $response;
    }
}
