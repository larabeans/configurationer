<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run(array $data)
    {
        try {
           // dd($data['configuration']);
            $configurationType = config('configuration.configurable_types');
            $index="";
            $type= $data['configurable_type'];

            // getting the address of configable type from the array of configurable_types from config file.
            foreach($configurationType as $key => $value){
                if($key == $type){
                    $index =$value['class_path'];
                }

            }
            if($index ==null){
                throw new NotFoundException();
            }

            $configurationData= json_encode($data['configuration']);

            $queryData=[
                'configurable_type'=>$index,
                'configurable_id'=>$data['configurable_id'],
                'configuration'=>$configurationData
            ];
            return $this->repository->create($queryData);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
