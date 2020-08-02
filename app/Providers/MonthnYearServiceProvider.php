<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider; 
use Illuminate\Support\Facades\App;

class MonthnYearServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('MonthnYear', function(){
            return new \App\Helpers\MonthnYear;
        });
        //
        // require_once app_path() . '/Helpers/ErrorRecording.php';
        // return ErrorRecording::ErrorRecords();
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
