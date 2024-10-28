<?php

namespace App\Providers;

use App\Interfaces\passwords\ForgetPasswordInterface;
use App\Repository\passwords\ForgetPassword;
use Illuminate\Support\ServiceProvider;

class ResetPasswordprovider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
       $this->app->bind(ForgetPasswordInterface::class,ForgetPassword::class);
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
