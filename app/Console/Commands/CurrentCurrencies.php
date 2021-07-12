<?php

namespace App\Console\Commands;

use App\Interfaces\ICurrencyRepositoryInterface;
use App\Services\CurrencyService;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Cache;

class CurrentCurrencies extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'currencies:get';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Get current currencies from API';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle(ICurrencyRepositoryInterface $currencyRepository)
    {
        $currentCurrencies = CurrencyService::regularizeResponce();

        Cache::put('availableCurrencies', $currentCurrencies);

        $updateRates = $currencyRepository->updateCurrenciesRates();

        if ($currentCurrencies && $updateRates){
            $this->info('Currencies has been updated');
        }else $this->error('Error');

    }
}
