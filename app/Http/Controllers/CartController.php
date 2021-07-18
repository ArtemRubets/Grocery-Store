<?php

namespace App\Http\Controllers;

use App\Classes\Cart;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\ICurrencyRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\View;

class CartController extends MainController
{

    private $productRepository;
    private $currencyRepository;

    public function __construct(IProductRepositoryInterface $productRepository, ICurrencyRepositoryInterface $currencyRepository){

        $this->productRepository = $productRepository;
        $this->currencyRepository = $currencyRepository;

    }

    public function addToCart($product_slug){

        $defaultCurrency = $this->currencyRepository->getMainCurrency();
        $product = $this->productRepository->getProduct($product_slug, session('currency_id', $defaultCurrency->id));

        if ($product->product_count <= 0){
            return redirect()->back()->with('cart_status', 'Out of stock!');
        }

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->add($product);

        if ($cart->items[$product->id]['itemQuantity'] <= $product->product_count){

            Session::put('cart' , $cart);
            return redirect()->back();
        }

        return redirect()->back()->with('cart_status', 'Few products');
    }

    public function removeFromCart($product_slug){
        $defaultCurrency = $this->currencyRepository->getMainCurrency();
        $product = $this->productRepository->getProduct($product_slug, session('currency_id', $defaultCurrency->id));

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->remove($product);

        Session::put('cart' , $cart);

        if (empty($cart->items)){
            Session::remove('cart');
        }

        return redirect()->back();
    }

    public function removeOneProduct($product_slug){
        $product = $this->productRepository->getProduct($product_slug);

        $oldCart = Session::has('cart') ? Session::get('cart') : null;
        $cart = new Cart($oldCart);

        $cart->removeOne($product);

        Session::put('cart' , $cart);

        return redirect()->back();
    }

    public function index(){

        $cart = Session::has('cart') ? Session::get('cart') : null;

        if (View::exists('cart')){
            return \view('cart' , compact('cart'));
        }
        abort(404);
    }
}
