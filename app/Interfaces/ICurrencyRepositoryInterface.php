<?php


namespace App\Interfaces;


interface ICurrencyRepositoryInterface
{

    public function getCurrenciesList();

    public function getCurrencyByCode($currencyCode);

    public function saveCurrency($currentData, $currencySymbol);
}
