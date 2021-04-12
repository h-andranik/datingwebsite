<?php

namespace App\Providers;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $interests = \App\Models\Interest::all();
        $astrology = Config::get('constants.astrology');
        view()->share([
            'interests' => $interests,
            'astrology' => $astrology
        ]);

    }
}
