<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\ICurrencyRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends MainController
{
    private $productRepository;
    private $currencyRepository;


    public function __construct(IProductRepositoryInterface $productRepository, ICurrencyRepositoryInterface $currencyRepository)
    {
        $this->productRepository = $productRepository;
        $this->currencyRepository = $currencyRepository;
    }

    public function index(Request $request, $product_slug)
    {
        $defaultCurrency = $this->currencyRepository->getMainCurrency();
        $product = $this->productRepository->getProduct($product_slug, session('currency_id', $defaultCurrency->id));

        if (View::exists('product')){
            return \view('product' , compact('product'));
        }
        abort(404);
    }

    public function subscription(EmailRequest $request, Product $product)
    {
       $email = $request->validated()['email'];

       if ($email){
          Subscription::create([
              'product_id' => $product->id,
              'email' => $email
          ]);

          return back()->with('status', 'We are subscribe');
       }
    }
}
