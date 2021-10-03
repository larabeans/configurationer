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

            $response =$this->repository->where('configurable_id',$id)->first();
            $configurationData= json_decode( $response->configuration);
            $data=[];
            if($response == null){
                throw new NotFoundException();
            }
           // $data['Language']=$configurationData->language;

            $data['configuration']=$configurationData;
            return $response;
        }
        catch (Exception $exception) {
            throw new NotFoundException($exception);
        }
    }
}
