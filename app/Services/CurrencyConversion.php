<?php


namespace App\Services;


use App\Models\Currency;
use Illuminate\Support\Carbon;

class CurrencyConversion
{
    protected static $container;

    public static function loadContainer()
    {
        if (is_null(self::$container)) {
            $currencies = Currency::get();
            foreach ($currencies as $currency) {
                self::$container[$currency->code] = $currency;
            }
//            //name:usd
//            //rate: 1.1
//            //symbol: $
//            //code: usd
//
//            //name: manat
//            //rate:1.7
//            //symbol: m
//            //code: azn
//
//            $arr = [
//                "usd" =>'',
//                //name:usd
//                //rate: 1.1
//                //symbol: $
//                //code: usd
//
//
//                'azn'
//                //name: manat
//                //rate:1.7
//                //symbol: m
//                //code: azn
//            ];
        }
    }

    public static function getCurrencies()
    {
        return self::$container;
    }

    public static function convert($sum, $originCurrencyCode = 'RUB', $targetCurrencyCode = null)
    {
        self::loadContainer();
//        $originCurrency = Currency::byCode($originCurrencyCode)->first();
        $originCurrency = self::$container[$originCurrencyCode];


        //stafkalari yenilemek ucun bele yoxlama olur
//        if ($originCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay())
//        {
//            CurrencyRates::getRates();
//            self::loadContainer();
//            $originCurrency = self::$container[$originCurrencyCode];
//        }
        if (is_null($targetCurrencyCode)) {
            $targetCurrencyCode = session('currency', 'RUB');
        }
        $targetCurrency = self::$container[$targetCurrencyCode];


        //stafkalari yenilemek ucun bele yoxlama olur
//        if ($targetCurrency->updated_at->startOfDay() != Carbon::now()->startOfDay())
//        {
//            CurrencyRates::getRates();
//            self::loadContainer();
//            $targetCurrency = self::$container[$originCurrencyCode];
//        }

        return $sum / $originCurrency->rate * $targetCurrency->rate;

    }

    public static function getCurrencySymbol()
    {
        self::loadContainer();
        $currencyFromSession = session('currency', 'RUB');
        $currency = self::$container[$currencyFromSession];
        return $currency->symbol;
    }

    public static function getBaseCurrency()
    {
        self::loadContainer();

        foreach (self::$container as $code => $currency)
        {
            if ($currency->isMain())
            {
                return $currency;
            }
        }
    }
}
