<?php

namespace App\Providers;

use App\Interfaces\Service\multi_services\Multi_serviceInterface;
use App\Interfaces\Service\single_service\Single_ServiceInterface;
use App\Repository\Service\multi_services\Multi_serviceRepository;
use App\Repository\Service\single_service\Single_Service;
use Illuminate\Support\ServiceProvider as SV;

class ServiceProvider extends SV
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(Single_ServiceInterface::class,Single_Service::class);
       $this->app->bind(Multi_serviceInterface::class,Multi_serviceRepository::class);
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
