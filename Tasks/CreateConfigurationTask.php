<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use Exception;
use Illuminate\Support\Facades\Auth;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;

class CreateConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        // TODO: Need Refactoring
        try {
            if ($data['configurable_type'] == 'host') {
                return $this->repository->create([
                    'configurable_type' => '',
                    'configurable_id' => '',
                    'configuration' => json_encode($data['configuration'])
                ]);
            } else {
                $configurationType = config('configurationer.entities');
                $index = "";
                $type = $data['configurable_type'];

                // getting the address of configable type from the array of configurable_entities from config file.
                foreach ($configurationType as $key => $value) {
                    if ($key == $type) {
                        $index = $value['model'];
                    }
                }
                if ($index == null) {
                    throw new NotFoundException();
                }
                $Configurable_id = null;
                if ($type == "user") {
                    $Configurable_id = Auth::user()->id;
                } elseif ($type == "tenant") {
                    //if data comming from TenantRegisteredListener, get tenant_id from data else from auth token
                    if (isset($data['tenant_id'])) {
                        $Configurable_id = $data['tenant_id'];
                    } else {
                        $Configurable_id = Auth::user()->tenant_id;
                    }
                }
                if ($Configurable_id == null) {
                    throw new NotFoundException("No " . ucfirst($type) . " Found");
                }

                $configurationData = json_encode($data['configuration']);

                if (!empty($this->repository->where("configurable_id", $Configurable_id)->first())) {
                    throw new NotFoundException("Configuration Already Exists");
                }
                $queryData = [
                    'configurable_type' => $index,
                    'configurable_id' => $Configurable_id,
                    'configuration' => $configurationData
                ];
                if ($data['configurable_type'] == "tenant") {
                    $queryData['tenant_id'] = $Configurable_id;
                }

                return $this->repository->create($queryData);
            }
        } catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
