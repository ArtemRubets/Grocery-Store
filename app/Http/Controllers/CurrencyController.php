<?php

namespace App\Http\Controllers;

use App\Interfaces\ICurrencyRepositoryInterface;
use App\Services\CurrencyService;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    private $currencyRepository;

    public function __construct(ICurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function addCurrency(Request $request)
    {
        $currencyCode = $request->input('add-currency');
        $currencySymbol = $request->input('symbol');

        $currentData = CurrencyService::findCurrencyByCode($currencyCode);

        $result = $this->currencyRepository->saveCurrency($currentData, $currencySymbol);

        if ($result) return redirect()->back()->with('flash_success', 'Currency has been added');
        return redirect()->back()->with('flash_error', 'Something went wrong');

    }

}
