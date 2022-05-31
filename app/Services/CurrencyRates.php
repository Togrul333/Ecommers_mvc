<?php


namespace App\Services;


use GuzzleHttp\Client;
use Exception;

class CurrencyRates
{
    public static function getRates()
    {
        $baseCurrency = CurrencyConversion::getBaseCurrency();
        // hemin https://api.exchangeratesapi.io/latest saytindan istifade edirik
        $url = config('currency_rates.api_url') . '?base=' . $baseCurrency->code;

        // burdada composer require guzzlehttp/guzzle bu poketi guzzleyi iwe salirig
        $client = new Client();

        $response = $client->request('GET', $url);

        if ($response->getStatusCode() !== 200) {
            throw new Exception('rate servisde problem var!!');
        }

//        $rates = json_decode($response->getBody()->getContents(),true);



//        $rates = json_decode($response->getBody()->getContents(),true)['rates'];

//        foreach (CurrencyConversion::getCurrencies() as $currency)
//        {
//            // eyer o esas olan valyuta deilse
//
//            if (!$currency->isMain())
//             {
//                 // ve eyer o bazada olan valyuta bu saytda yoxdusa
//                 if (!isset($rates[$currency->code]))
//                 {
//                     throw new Exception('rate servisde problem var!!'.$currency->code);
//                 }
//                 else{
//                     $currency->update(['rate'=>$rates[$currency->code]]);
//                 }
//             }
//        }

//        dd($rates);
    }
}
