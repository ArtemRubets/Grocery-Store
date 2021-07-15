<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $currencyCode = $request->input('add-currency');
        $currencySymbol = $request->input('symbol');

        $currentData = CurrencyService::findCurrencyByCode($currencyCode);

        $result = $this->currencyRepository->saveCurrency($currentData, $currencySymbol);

        if ($result) {
            return redirect()->back()
                ->with('add_currency_message', 'Currency has been added');
        }
        return redirect()->back()
            ->with('add_currency_message', 'Something went wrong')
            ->with('flash_error', 1);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }


    public function destroyMany(Request $request)
    {
        $selectedCurrencies = $request->except(['_token', '_method']);

        $destroyed = $this->currencyRepository->destroyCurrencies($selectedCurrencies);

        if ($destroyed) {
            return redirect()->back()
                ->with('destroy_currency_message', 'Currency has been destroyed');
        }
        return redirect()->back()
            ->with('destroy_currency_message', 'You try to delete all currencies!')
            ->with('flash_error', 1);
    }
}
