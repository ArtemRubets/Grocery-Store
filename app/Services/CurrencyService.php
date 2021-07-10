<?php


namespace App\Services;

use App\Interfaces\ICurrencyRepositoryInterface;

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
}
