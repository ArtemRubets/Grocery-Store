<?php

namespace App\Providers;

use App\Interfaces\ICurrencyRepositoryInterface;
use App\Repositories\CurrencyRepository;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public $singletons = [
        ICurrencyRepositoryInterface::class => CurrencyRepository::class
    ];

    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot(ICurrencyRepositoryInterface $currencyRepository)
    {
        $currenciesList = $currencyRepository->getCurrenciesList();
        View::share('currenciesList', $currenciesList);
    }
}
