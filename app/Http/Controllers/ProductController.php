<?php

namespace App\Http\Controllers;

use App\Http\Requests\EmailRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use App\Models\Product;
use App\Models\Subscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class ProductController extends MainController
{
    private $productRepository;


    public function __construct(IProductRepositoryInterface $productRepository,
                                ICategoryRepositoryInterface $categoryRepository,)
    {
        parent::__construct($categoryRepository);

        $this->productRepository = $productRepository;
    }

    public function index(Request $request, $product_slug)
    {

        $categoriesList = parent::getCategoriesList();
        $product = $this->productRepository->getProduct($product_slug);

        if (View::exists('product')){
            return \view('product' , compact('product' , 'categoriesList'));
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