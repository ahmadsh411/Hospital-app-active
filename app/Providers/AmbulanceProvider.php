<?php

namespace App\Providers;

use App\Interfaces\Ambulances\AmbulanceInterface;
use App\Repository\Ambulances\AmbulanceRepository;
use Illuminate\Support\ServiceProvider;

class AmbulanceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(AmbulanceInterface::class,AmbulanceRepository::class);
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
