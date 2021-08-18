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
use function React\Promise\reduce;

class ProductController extends MainController
{
    private $productRepository;


    public function __construct(IProductRepositoryInterface $productRepository)
    {
        $this->productRepository = $productRepository;
    }

    public function index($product_slug)
    {
        $product = $this->productRepository->getProduct($product_slug);

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

    public function productsSearch(Request $request)
    {
        $productName = $request->input('product_search');

        if ($productName){
            $productsFound = $this->productRepository->searchProducts($productName);
        }
        if (View::exists('search') && isset($productsFound)){
            return \view('search', compact('productsFound'));
        }

        return redirect()->back();
    }
}
