<?php


namespace App\Repositories;


use App\Interfaces\IProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ProductRepository extends CoreRepository implements IProductRepositoryInterface
{
    public function getModel(){
        return Product::class;
    }

    public function getCategoryProducts($category){
        $columns = ['id', 'category_id', 'product_name', 'product_slug', 'product_image', 'is_offer', 'offer_percent', 'product_count'];

       $categoryProducts = $this->startCondition()->with('price')->where('category_id', $category->id)
            ->orderBy('created_at')->orderBy('product_count', 'desc')->get($columns);

        return $this->getProductsWithPrices($categoryProducts);
    }

    public function getCategoryProductsForDashboard($category){
        $columns = ['id', 'category_id', 'product_name', 'product_slug', 'product_image', 'is_offer', 'product_count', 'deleted_at'];

        $categoryProducts = $this->startCondition()->where('category_id', $category->id)
            ->orderBy('created_at')->orderBy('product_count', 'desc')->get($columns);

        return $categoryProducts;
    }

    public function getProduct($product_slug){
        $columns = [
            'id', 'category_id', 'product_name', 'product_slug', 'product_image', 'product_description', 'rating',
            'is_offer', 'offer_percent', 'product_count', 'deleted_at'
        ];

        $product = $this->startCondition()->where('product_slug' , $product_slug)
            ->firstOrFail($columns);

        $price = $this->getPrice($product);

        $product->product_price = $price;

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
        return $this->startCondition()->productTrashed($id)->firstOrFail()->restore();
    }

    public function productUpdate($product, $validatedInputs)
    {
        if ($validatedInputs){

            //TODO Cut element from array
            $product_prices = $validatedInputs['product_prices'];
            unset($validatedInputs['product_prices']);

            //TODO Doesn't work in observer. Why?
            $validatedInputs['is_offer'] = $validatedInputs['is_offer'] ?? false;

            foreach ($product_prices as $currencyId => $product_price){

                foreach ($product->price as $productPriceModel) {

                    if ($productPriceModel->currency_id == $currencyId){

                        $productPriceModel->price = round($product_price['price'], 2);
                        $productPriceModel->save();
                    }
                }
            }
        }
        return $product->update($validatedInputs);
    }

    public function productStore($validatedInputs)
    {
        if ($validatedInputs) {

            //TODO Cut element from array
            $product_prices = $validatedInputs['product_prices'];
            unset($validatedInputs['product_prices']);

            $validatedInputs['is_offer'] = $validatedInputs['is_offer'] ?? false;

            $storeProduct = $this->startCondition()->create($validatedInputs);

            foreach ($product_prices as $currencyId => $product_price){

                $storeProduct->productPrices()
                    ->attach([$storeProduct->id], ['currency_id' => $currencyId, 'price' => round($product_price['price'], 2)]);
            }

            return $storeProduct ?? true;
        }
    }

    public function forceDelete($id){

        $product = $this->startCondition()->productTrashed($id)->firstOrFail();

        Storage::delete($product->product_image);

        $product->productPrices()->detach();

        return $product->forceDelete();
    }

    public function getPrice($product)
    {
        $price = $product->price;

        return $price->where('currency_id', session('currency')->id)->first()->price;
    }

    public function searchProducts($searchQuery)
    {
       $foundProducts = $this->startCondition()->with('price')->where('product_name', 'like', "%$searchQuery%")->get();

        return $this->getProductsWithPrices($foundProducts);
    }

    protected function getProductsWithPrices(Collection $products)
    {
        if (count($products) > 0){

            foreach ($products as $product){
                $price = $this->getPrice($product);

                $product->product_price = $price;

                if ($product->is_offer){
                    $priceWithOffer = round($product->product_price - ( $product->product_price * $product->offer_percent / 100 ), 2);

                    $product->product_price_with_offer = $priceWithOffer;
                }
            }
            return $price ? $products : $products->except($product->id);
        }
    }
}
