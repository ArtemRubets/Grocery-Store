<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Http\Controllers\MainController;
use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\View;

class TrashController extends MainController
{
    private $productRepository;


    public function __construct(IProductRepositoryInterface $productRepository){

        $this->productRepository = $productRepository;
    }

    public function productsTrashIndex()
    {

        $TrashedProducts = $this->productRepository->getTrashedProducts();

        if (View::exists('dashboard.pages.products-trash')){
            return \view('dashboard.pages.products-trash', compact('TrashedProducts'));
        }
        abort(404);
    }

    public function forceDelete($id){
        if ($id){
            $deleted = $this->productRepository->forceDelete($id);

            if ($deleted) return redirect()->route('dashboard.trash.products.index')->with('product_status', 'Product was deleted');
            return redirect()->route('dashboard.trash.products.index')
                ->with('product_status' , 'Product was not deleted!')
                ->with('product_error' , true);
        }
    }

    public function restore($id){
        if ($id){
            $restored = $this->productRepository->productRestore($id);

            if ($restored) return redirect()->route('dashboard.trash.products.index')->with('product_status', 'Product was restored');
            return redirect()->route('dashboard.trash.products.index')
                ->with('product_status' , 'Product was not restored!')
                ->with('product_error' , true);
        }
    }
}
