<?php


namespace App\Repositories;


use App\Interfaces\ICurrencyRepositoryInterface;
use App\Models\Currency;
use App\Services\CurrencyService;

class CurrencyRepository extends CoreRepository implements ICurrencyRepositoryInterface
{

    public function getModel(){
        return Currency::class;
    }

    public function setDefaultCurrency($currencyCode = 'UAH')
    {
        if ($currencyCode){
            $currency = $this->getCurrencyByCode($currencyCode);
            $currenciesList = $this->getCurrenciesList();

            foreach ($currenciesList as $item){
                $item->where('status', 1)->update(['status' => 0]);
            }

            $currency->status = 1;
            $currency->save();

            return $currency;
        }

        return false;
    }

    public function getCurrenciesList()
    {
        return $this->startCondition()->get(['code', 'symbol', 'rate', 'status']);
    }

    public function getCurrencyByCode($currencyCode)
    {
        return $this->startCondition()->where('code', $currencyCode)->firstOrFail();
    }

    public function saveCurrency($currentData, $currencySymbol)
    {
        if ($currentData && $currencySymbol){

            return $this->startCondition()->create([
                'symbol' => $currencySymbol,
                'code' => $currentData->cc,
                'rate' => round($currentData->rate, 2),
                'status' => 0
            ]);
        }
    }

    public function updateCurrenciesRates()
    {
        $currenciesOld = $this->getCurrenciesList();
        $currenciesNew = CurrencyService::getAvailableCurrencies();

        $currentRates = $currenciesNew->filter(function ($item) use ($currenciesOld) {
            foreach ($currenciesOld as $key => $value) {
                if($value->code == $item->cc){
                    return $item;
                }
            }
            return null;
        });

        $bdResults = $this->startCondition()->where('status', 0)->get();

        foreach ($bdResults as $bdResult) {
            foreach ($currentRates as $rate) {
                $bdResult->where('code', $rate->cc)->update([
                    'rate' => round($rate->rate, 2)
                ]);
            }
        }
    }
}
