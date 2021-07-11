<?php


namespace App\Services;

use App\Interfaces\ICurrencyRepositoryInterface;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class CurrencyService
{
    protected $currencyRepository;

    public function __construct(ICurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function setDefaultCurrency($currencyCode = 'UAH')
    {
        if ($currencyCode){
            $currency = $this->currencyRepository->getCurrencyByCode($currencyCode);
            $currenciesList = $this->currencyRepository->getCurrenciesList();

            foreach ($currenciesList as $item){
                $item->where('status', 1)->update(['status' => 0]);
            }

            $currency->status = 1;
            $currency->save();

            return $currency;
        }

        throw new \Exception('Currency code is null');
    }

    public static function getAvailableCurrencies()
    {

        $response = Http::get(config('payments.currency.API_url'), [
            'json'
        ]);

        if ($response->failed()){
            Log::error('Can\'t take data on request '. config('payments.currency.API_url'));
            $response->throw();
        }

        $collect = collect($response->object());

        $filtered = $collect->filter(function ($value){
            //TODO How to do shorten?
            return $value->cc !== 'XAU' && $value->cc !== 'XAG' && $value->cc !== 'XPT' && $value->cc !== 'XPD';
        });

        return $filtered;
    }

    public static function findCurrencyByCode($code)
    {
        $currencies = self::getAvailableCurrencies();

        return $currencies->where('cc', $code)->first();
    }
}
