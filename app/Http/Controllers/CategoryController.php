<?php

namespace App\Http\Controllers;

use App\Classes\ProductFilter;
use App\Http\Requests\CategoryFilterRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use Illuminate\Support\Facades\View;

class CategoryController extends MainController
{
    private $productRepository;


    public function __construct(IProductRepositoryInterface $productRepository , ICategoryRepositoryInterface $categoryRepository){
        parent::__construct($categoryRepository);

        $this->productRepository = $productRepository;
    }

    public function index(CategoryFilterRequest $request, $category_slug){

        $categoriesList = parent::getCategoriesList();
        $category = $this->categoryRepository->getCategory($category_slug);

        $categoryProductsAll = $this->productRepository->getCategoryProducts($category);

        $categoryProductsFiltered = (new ProductFilter($categoryProductsAll, $request))->apply();

        if (View::exists('category')){
            return \view('category' , compact(['categoryProductsFiltered', 'categoryProductsAll' , 'categoriesList' , 'category']));
        }
        abort(404);
    }
}
