<?php

namespace App\Containers\AppSection\Configurationer\Tasks;

use App\Containers\AppSection\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\CreateResourceFailedException;
use App\Ship\Parents\Tasks\Task;
use Exception;

class CreateConfigurationerTask extends Task
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
            $configurationType = config('configuration.configable_types');
            $index="";
            $type= $data['configable_type'];

            // getting the address of configable type from the array of configable_types from config file.
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
                'configable_type'=>$index,
                'configable_id'=>$data['configable_id'],
                'configuration'=>$configurationData
            ];
            return $this->repository->create($queryData);
        }
        catch (Exception $exception) {
            throw new CreateResourceFailedException($exception);
        }
    }
}
