<?php


namespace App\Classes;


use App\Jobs\SendingMail;
use App\Models\Product;
use App\Models\Subscription;

class SendSubscribe
{

    public static function send(Product $product)
    {
        $countOld = $product->getOriginal('product_count');
        $count = $product->product_count;

        if ($countOld == 0 && $count > 0){

            $modelsCollection = Subscription::getInStockAlert($product);

            SendingMail::dispatch($modelsCollection, $product)->delay(now()->addSeconds(30));

        }
    }

}
