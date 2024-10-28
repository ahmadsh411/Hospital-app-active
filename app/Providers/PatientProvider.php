<?php

namespace App\Providers;

use App\Interfaces\Patients\PatientInterface;
use App\Repository\Patients\PatientRepository;
use Illuminate\Support\ServiceProvider;

class PatientProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(PatientInterface::class,PatientRepository::class);
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
