<?php

namespace App\Http\Controllers;

use App\Interfaces\ICurrencyRepositoryInterface;

class CurrencyController extends Controller
{
    private $currencyRepository;

    public function __construct(ICurrencyRepositoryInterface $currencyRepository)
    {
        $this->currencyRepository = $currencyRepository;
    }
    public function changeCurrency($code)
    {

    }
}
