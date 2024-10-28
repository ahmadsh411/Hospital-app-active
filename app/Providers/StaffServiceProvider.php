<?php

namespace App\Providers;

use App\Interfaces\Staffs\StaffInterface;
use App\Repository\Staffs\StaffRepository;
use Illuminate\Support\ServiceProvider;

class StaffServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        $this->app->bind(StaffInterface::class, StaffRepository::class);
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
