<?php


namespace App\Repositories;


use App\Interfaces\IProductRepositoryInterface;
use App\Models\Product;

class ProductRepository extends CoreRepository implements IProductRepositoryInterface
{
    public function getModel(){
        return Product::class;
    }

    public function getCategoryProducts($category){

        $categoryProducts = $this->startCondition()->where('category_id', $category->id)
            ->orderBy('created_at')
            ->orderBy('product_count', 'desc')->get();

        foreach ($categoryProducts as $product){
            if ($product->is_offer){
                $priceWithOffer = round($product->product_price - ( $product->product_price * $product->offer_percent / 100 ), 2);

                $product->product_price_with_offer = $priceWithOffer;
            }
        }

        return $categoryProducts;
    }

    public function getProduct($product_slug){
        $product = $this->startCondition()->where('product_slug' , $product_slug)
            ->firstOrFail();
        if ($product->is_offer){
            $priceWithOffer = round($product->product_price - ( $product->product_price * $product->offer_percent / 100 ), 2);

            $product->product_price_with_offer = $priceWithOffer;
        }
        return $product;
    }

    public function getProductForDashboard($id){
        $product = $this->startCondition()->findOrFail($id);
        if ($product->is_offer){
            $priceWithOffer = round($product->product_price - ( $product->product_price * $product->offer_percent / 100 ), 2);

            $product->product_price_with_offer = $priceWithOffer;
        }
        return $product;
    }

    public function find($id){
        return $this->startCondition()->findOrFail($id);
    }

    public function getTrashedProducts(){
        return $this->startCondition()->onlyTrashed()->get();
    }

    public function productRestore($id){
        return $this->startCondition()->withTrashed()->where('id', $id)->restore();
    }

    public function forceDelete($id){
        return $this->startCondition()->withTrashed()->where('id', $id)->forceDelete();
    }

}
