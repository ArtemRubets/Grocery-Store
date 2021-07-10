<?php

namespace App\Providers;

use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\ICurrencyRepositoryInterface;
use App\Interfaces\IOrderRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use App\Repositories\CategoryRepository;
use App\Repositories\CurrencyRepository;
use App\Repositories\OrderRepository;
use App\Repositories\ProductRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        $this->app->bind(IProductRepositoryInterface::class , ProductRepository::class);
        $this->app->bind(ICategoryRepositoryInterface::class , CategoryRepository::class);
        $this->app->bind(IOrderRepositoryInterface::class , OrderRepository::class);
        $this->app->bind(ICurrencyRepositoryInterface::class , CurrencyRepository::class);
    }
}
