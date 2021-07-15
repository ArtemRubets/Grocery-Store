<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Interfaces\ICurrencyRepositoryInterface;
use App\Services\CurrencyService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class PaymentsController extends Controller
{
    private $currencyRepository;

    public function __construct(ICurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }

    public function index()
    {
        $currenciesList = $this->currencyRepository->getCurrenciesList();

        $availableCurrencies = CurrencyService::getAvailableCurrencies($currenciesList);

        $mainCurrency = $this->currencyRepository->getMainCurrency();

        if (View::exists('dashboard.pages.payments')){
            return \view('dashboard.pages.payments', compact('availableCurrencies', 'mainCurrency'));
        }
        abort(404);
    }

    public function setPaymentsSettings(Request $request)
    {
        //TODO not finalized
        $defaultCurrency = $this->currencyRepository->setDefaultCurrency($request->input('default-currency'));

        if ($defaultCurrency) return redirect()->back()
            ->with('setDefaultStatus', 'Default currency was changed');
        return redirect()->back()
            ->with('setDefaultStatus', 'Default currency wasn\'t changed')->with('setDefaultError', true);
    }
}
