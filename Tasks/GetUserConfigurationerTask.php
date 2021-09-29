<?php

namespace App\Containers\AppSection\Configurationer\Tasks;

use App\Containers\AppSection\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class GetUserConfigurationerTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run($id)
    {
        try {

            $response =$this->repository->where('configable_id',$id)->first();
            $configurationData= json_decode( $response->configuration);
            $data=[];
            $data['Language']=$configurationData->language;
            //dd($data);
            return $data;
        }
        catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
