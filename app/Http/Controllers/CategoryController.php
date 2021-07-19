<?php

namespace App\Http\Controllers;

use App\Classes\ProductFilter;
use App\Http\Requests\CategoryFilterRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\ICurrencyRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use Illuminate\Support\Facades\View;

class CategoryController extends MainController
{
    private $productRepository;
    private $categoryRepository;

    public function __construct(IProductRepositoryInterface $productRepository,
                                ICategoryRepositoryInterface $categoryRepository){

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    public function index(CategoryFilterRequest $request, $category_slug){

        $category = $this->categoryRepository->getCategory($category_slug);

        $categoryProductsAll = $this->productRepository->getCategoryProducts($category);

        $categoryProductsFiltered = (new ProductFilter($categoryProductsAll, $request))->apply();

        if (View::exists('category')){
            return \view('category' , compact(['categoryProductsFiltered', 'categoryProductsAll' , 'category']));
        }
        abort(404);
    }
}
