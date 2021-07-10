<?php


namespace App\Classes;


use App\Models\Product;

class Cart
{
    public $items = null;
    public $totalQuantity = 0;
    public $totalPrice = 0;

    public function __construct($oldCart){
        if ($oldCart){
            $this->items = $oldCart->items;
            $this->totalQuantity = $oldCart->totalQuantity;
            $this->totalPrice = $oldCart->totalPrice;
        }
    }

    public function add(Product $product){

        $productPrice = $product->is_offer ? $product->product_price_with_offer : $product->product_price;

        $storedItem = ['item' => $product, 'price' => $productPrice , 'itemQuantity' => 0];

        if ($this->items){
            if (array_key_exists($product->id , $this->items)){
                $storedItem = $this->items[$product->id];
            }
        }

        $storedItem['itemQuantity']++;
        $storedItem['price'] = $storedItem['itemQuantity'] * $productPrice;

        $this->totalQuantity++;
        $this->totalPrice += $productPrice;
        $this->items[$product->id] = $storedItem;

    }

    public function remove(Product $product){
        $this->totalQuantity -= $this->items[$product->id]['itemQuantity'];
        $this->totalPrice -= $this->items[$product->id]['price'];

        unset($this->items[$product->id]);
    }

    public function removeOne(Product $product){
        $productPrice = $product->is_offer ? $product->product_price_with_offer : $product->product_price;

        if ($this->items[$product->id]['itemQuantity'] > 1){
            $this->totalQuantity--;
            $this->totalPrice -= $productPrice;
            $this->items[$product->id]['itemQuantity']--;
            $this->items[$product->id]['price'] -= $productPrice;
        }

    }

}
