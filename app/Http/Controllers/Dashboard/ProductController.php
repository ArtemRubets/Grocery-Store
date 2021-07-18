<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\MainController;
use App\Http\Requests\ProductRequest;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\View;

class ProductController extends MainController
{
    private $productRepository;
    private $categoryRepository;


    public function __construct(IProductRepositoryInterface $productRepository,
                                ICategoryRepositoryInterface $categoryRepository,){

        $this->productRepository = $productRepository;
        $this->categoryRepository = $categoryRepository;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Request $request)
    {
        $categoryId = $request->get('category');
        $category = $this->categoryRepository->find($categoryId);

        $products = $this->productRepository->getCategoryProducts($category);

        if (View::exists('dashboard.pages.product-index')){
            return \view('dashboard.pages.product-index', compact('products', 'category'));
        }
        abort(404);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $categories = $this->categoryRepository->getCategoriesListForSelects();

        if (View::exists('dashboard.pages.product-create')){
            return \view('dashboard.pages.product-create' , compact('categories'));
        }
        abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        $inputs = $request->validated();

        if ($inputs){

            if (!isset($inputs['is_offer'])) $inputs['is_offer'] = false;

            $create = $this->productRepository->getModel()::create($inputs);

            if ($create) return redirect()->route('dashboard.products.index', ['category' => $inputs['category_id']])
                ->with('product_status' , 'Product successful create!');
            return redirect()->route('dashboard.products.index', ['category' => $inputs['category_id']])
                ->with('product_status' , 'Error creating product!')
                ->with('product_error' , true);

        }
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function edit($id)
    {
        $categories = $this->categoryRepository->getCategoriesListForSelects();

        $product = $this->productRepository->getProductForDashboard($id);

        if (View::exists('dashboard.pages.product-edit')){
            return \view('dashboard.pages.product-edit' , compact('categories' , 'product'));
        }
        abort(404);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(ProductRequest $request, $id)
    {
        $inputs = $request->validated();

        $product = $this->productRepository->find($id);

        if (!$product) abort(404);

        if ($inputs){

            //TODO don't work in observer. Why?
            if (!isset($inputs['is_offer'])) $inputs['is_offer'] = false;

            $update = $product->update($inputs);

            if ($update) return redirect()->route('dashboard.products.index', ['category' => $product->category_id])
                ->with('product_status' , 'Product successful update!');
            return redirect()->route('dashboard.products.index', ['category' => $product->category_id])
                ->with('product_status' , 'Error update product!')
                ->with('product_error' , true);

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function destroy($id)
    {
        $product = $this->productRepository->find($id);

        if ($product){

            if (!$product) return back();

            $delete = $product->delete();
            Storage::delete($product->product_image);

            if ($delete) return back()->with('product_status' , 'Product successful delete!');
            return back()->with('product_status' , 'Error delete product!')
                ->with('product_error' , true);
        }
    }
}
