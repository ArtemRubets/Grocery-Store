<?php

namespace App\Http\Controllers;

use App\Interfaces\ICurrencyRepositoryInterface;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends MainController
{
    private $currencyRepository;

    public function __construct(ICurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }


    /*
     * Process
     * */
    public function changeCurrency($currencyCode)
    {
        $currency = $this->currencyRepository->getCurrencyByCode($currencyCode);

        session(['currency' => $currency->symbol]);

        CurrencyService::convert($currency);

        return redirect()->back();

    }
}
