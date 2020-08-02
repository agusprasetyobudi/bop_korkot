<?php
namespace App\Helpers;

use Carbon\Carbon;

// use App\Models\ErrorReporting;
// use Illuminate\Database\QueryException;

class MonthnYear {
    public function getList()
    {
        $date = Carbon::now();
        return (object)['month'=>array(1=>'Januari',
        2=>'Februari',
        3=>'Maret',
        4=>'April',
        5=>'Mei',
        6=>'Juni',
        7=>'Juli',
        8=>'Agustus',
        9=>'September',
        10=>'Oktober',
        11=>'November',
        12=>'Desember'),
        'year'=> range($date->year,2014)
    ];

    }
    // public function year()
    // {
    //     # code...
       
    //     return ;
    // }
}