<?php


namespace App\Repositories;


use App\Interfaces\ICurrencyRepositoryInterface;
use App\Models\Currency;
use App\Services\CurrencyService;

class CurrencyRepository extends CoreRepository implements ICurrencyRepositoryInterface
{

    public function getModel()
    {
        return Currency::class;
    }

    public function setDefaultCurrency($currencyCode = 'UAH')
    {
        if ($currencyCode) {
            $currency = $this->getCurrencyByCode($currencyCode);
            $currenciesList = $this->getCurrenciesList();

            foreach ($currenciesList as $item) {
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
        return $this->startCondition()->get(['id', 'code', 'symbol', 'rate', 'status', 'updated_at']);
    }

    public function getCurrencyByCode($currencyCode)
    {
        return $this->startCondition()->where('code', $currencyCode)->firstOrFail();
    }

    public function saveCurrency($currentData, $currencySymbol)
    {
        if ($currentData && $currencySymbol) {

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
            foreach ($currenciesOld as $value) {
                if ($value->code == $item->cc) {
                    return $item;
                }
            }
            return null;
        });

        $bdResults = $this->startCondition()->notMainCurrencies()->get();

        foreach ($bdResults as $bdResult) {
            foreach ($currentRates as $rate) {

                if ($bdResult->code == $rate->cc){
                    $updated = $bdResult->where('code', $rate->cc)->update([
                        'rate' => round($rate->rate, 2)
                    ]);
                }

            }
        }
        return $updated;
    }

    public function destroyCurrencies($selectedCurrencies)
    {
        $countAll = $this->startCondition()->count();
        $count = count($selectedCurrencies);

        $difference = $countAll - $count;

        if ($difference < 1){
            return false;
        }

        foreach ($selectedCurrencies as $selectedCurrency){
            $destroyed = $this->startCondition()->destroy($selectedCurrency);
        }

        return $destroyed;
    }

    public function getMainCurrency()
    {
        return $this->startCondition()->where('status', 1)->firstOrFail(['id', 'code', 'symbol']);
    }
}
