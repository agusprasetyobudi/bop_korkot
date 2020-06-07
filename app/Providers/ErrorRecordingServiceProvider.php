<?php

namespace App\Providers;
 
use Illuminate\Support\ServiceProvider; 
use Illuminate\Support\Facades\App;

class ErrorRecordingServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        App::bind('ErrorReports', function(){
            return new \App\Helpers\ErrorRecording;
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
