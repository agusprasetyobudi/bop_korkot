<?php
namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ErrorReport extends Facade{
    protected static function getFacadeAccessor(){return 'ErrorReports';}
}