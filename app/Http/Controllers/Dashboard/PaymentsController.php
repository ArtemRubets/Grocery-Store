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
        $availableCurrencies = CurrencyService::getAvailableCurrencies();

        if (View::exists('dashboard.pages.payments')){
            return \view('dashboard.pages.payments', compact('availableCurrencies'));
        }
        abort(404);
    }

    public function setPaymentsSettings(Request $request)
    {
        $defaultCurrency = (new CurrencyService($this->currencyRepository))
            ->setDefaultCurrency($request->input('default-currency'));

        if ($defaultCurrency) return back();
    }
}
