<?php

namespace App\Providers;

use App\Interfaces\Insurances\InsuranceInterface;
use App\Repository\Insurances\InsuranceRepository;
use Illuminate\Support\ServiceProvider;

class InsuranceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(InsuranceInterface::class,InsuranceRepository::class);
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
