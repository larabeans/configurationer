<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Exceptions\UpdateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;
use App\Containers\Vendor\Configurationer\Tasks\CreateConfigurationHistoryTask;

class UpdateConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($type, array $data)
    {
        $configurable_id=null;
        try {
            if ($type == "user") {
                $configurable_id=Auth::user()->id;

            } else if($type == "tenant") {
                $configurable_id=Auth::user()->tenant_id;
            }
            $configuration = $this->repository->where('configurable_id',$configurable_id)->first();
            if(!$configuration){

                throw new NotFoundException();
            }

            $history = app(CreateConfigurationHistoryTask::class)->run([$configuration->id,$configuration->configuration]);
            return $this->repository->update($data,$configuration->id);
        } catch (Exception $exception) {
            throw new UpdateResourceFailedException();
        }
    }
}
