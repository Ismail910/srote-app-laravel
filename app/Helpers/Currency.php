<?php


namespace App\Helpers;

use NumberFormatter;

class Currency {
    static function format($amount, $currency =null)
    {
       $formatter =  new NumberFormatter(config('app.locale'), NumberFormatter::CURRENCY);
       if($currency === null){
        $currency = config('app.currency', 'USD');
       }
       return $formatter->formatCurrency($amount , $currency);
    }
}