<?php


namespace App\Repositories;


use App\Interfaces\ICurrencyRepositoryInterface;
use App\Models\Currency;

class CurrencyRepository extends CoreRepository implements ICurrencyRepositoryInterface
{

    public function getModel(){
        return Currency::class;
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
                'rate' => $currentData->rate,
                'status' => 0
            ]);

        }

    }
}
