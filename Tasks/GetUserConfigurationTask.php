<?php

namespace App\Containers\Vendor\Configurationer\Tasks;

use App\Containers\AppSection\Authentication\Tasks\GetAuthenticatedUserTask;
use App\Containers\Vendor\Configurationer\Data\Repositories\ConfigurationRepository;
use App\Ship\Exceptions\NotFoundException;
use App\Ship\Parents\Tasks\Task;
use Exception;
use Illuminate\Support\Facades\Auth;

class GetUserConfigurationTask extends Task
{
    protected ConfigurationRepository $repository;

    public function __construct(ConfigurationRepository $repository)
    {
        $this->repository = $repository;
    }

    public function run()
    {
        try {
            $user = app(GetAuthenticatedUserTask::class)->run();


            $response = $this->repository->where('configurable_id', Auth::id())->first();
//            $configurationData = json_decode($response->configuration);
//            $data = [];
//            if ($response == null) {
//                throw new NotFoundException();
//            }
//            // $data['Language']=$configurationData->language;
//
//            $data['configuration'] = $configurationData;
            return $response;
        } catch (Exception $exception) {
            throw new NotFoundException();
        }
    }
}
