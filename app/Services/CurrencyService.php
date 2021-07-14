<?php


namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    public static function getAvailableCurrencies($currenciesList = null)
    {
        if (!Cache::has('availableCurrencies')){
            Artisan::call('currencies:get');
        }

        $availableCurrencies = Cache::get('availableCurrencies')->sortBy('cc');

        if ($currenciesList){
            $availableCurrenciesFiltered = $availableCurrencies->reject(function ($item) use ($currenciesList) {
                foreach ($currenciesList as $key => $value) {
                    if ($value->code == $item->cc) {
                        return $item;
                    }
                }
                return null;
            });
            return $availableCurrenciesFiltered;
        }

        return $availableCurrencies;
    }

    public static function findCurrencyByCode($code)
    {
        $currencies = self::getAvailableCurrencies();

        return $currencies->where('cc', $code)->first();
    }

    private static function getResponce()
    {
        $response = Http::get(config('payments.currency.API_url'), [
            'json'
        ]);

        if ($response->failed()){
            Log::error('Can\'t take data from request '. config('payments.currency.API_url'));
            $response->throw();
        }

        return $response;
    }

    public static function regularizeResponce()
    {
        $response = self::getResponce();

        $collect = collect($response->object());

        $exceptions = ['XAU', 'XAG', 'XPT', 'XPD'];

        return $collect->reject(function ($item) use ($exceptions){

            foreach ($exceptions as $key => $value){
                if ($item->cc == $value) return $item;
            }

        });
    }

}
