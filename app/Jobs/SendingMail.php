<?php

namespace App\Jobs;

use App\Mail\InStockAlert;
use App\Models\Product;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class SendingMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $product;
    protected $subscriptions;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($subscriptions, Product $product)
    {
        $this->product = $product;
        $this->subscriptions = $subscriptions;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        foreach ($this->subscriptions as $item){
            $item->status = true;
            $item->save();

            Mail::to($item->email)->send(new InStockAlert($this->product));
        }
    }
}
