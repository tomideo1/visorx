<?php

namespace App\Providers;

use Validator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Validator::extend('alpha_spaces', function ($attribute,$value){
           return preg_match('/^[\pL\s]+$/u',$value);
        });

        Validator::extend('mac_address', function ($attribute,$value){
            return preg_match('/^([a-fA-F0-9]{2}:){5}[a-fA-F0-9]{2}$/',$value);
        });
    }

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }
}
