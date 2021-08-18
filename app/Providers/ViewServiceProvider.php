<?php

namespace App\Providers;

use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\ICurrencyRepositoryInterface;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot(ICategoryRepositoryInterface $categoryRepository, ICurrencyRepositoryInterface $currencyRepository)
    {
        View::composer(['index', 'cart', 'category', 'product', 'auth', 'search'], function ($view) use ($currencyRepository, $categoryRepository) {
            $view->with('categoriesList', $categoryRepository->getCategoriesList())
            ->with('viewName', $view->getName())
            ->with('currency', session('currency', $currencyRepository->getMainCurrency()));
        });
    }
}
