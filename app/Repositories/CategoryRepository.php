<?php


namespace App\Repositories;


use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\Category;
use Illuminate\Support\Facades\Storage;

class CategoryRepository extends CoreRepository implements ICategoryRepositoryInterface
{
    public function getModel(){
        return Category::class;
    }

    public function getCategoriesList(){
        return $this->startCondition()->where('parent_category' , 0)->excerptWithoutCategory()
            ->with('child')->get(['id', 'category_name' , 'category_slug', 'parent_category']);
    }

    public function getCategoriesListForDashboard(){
        return  $this->startCondition()->with('child')
            ->get(['id' , 'category_name' , 'category_slug' , 'category_image' , 'parent_category']);
    }

    public function getCategoriesListForSelects(){
        return $this->startCondition()->get(['id' , 'category_name']);
    }

    public function getCategoriesListForProductCategories(){
        return $this->startCondition()->get(['id' , 'category_name', 'category_slug', 'category_image']);
    }

    public function getCategoriesListForCategories(){
        return $this->startCondition()->excerptWithoutCategory()->get(['id' , 'category_name', 'category_slug', 'category_image']);
    }

    public function getCategory($category_slug){
        return $this->startCondition()->where('category_slug' , $category_slug)->excerptWithoutCategory()->firstOrFail();
    }

    public function find($id){
        return $this->startCondition()->excerptWithoutCategory()->findOrFail($id);
    }

    public function findForProducts($id){
        return $this->startCondition()->findOrFail($id);
    }

    public function getWithoutCategory()
    {
        return $this->startCondition()->firstWhere('category_slug', 'without-category');
    }

    public function categoryDelete($category)
    {
        Storage::delete($category->category_image);

        foreach ($category->products as $product){
            $product->category_id = $this->getWithoutCategory()->id;
            $product->save();
        }
        return $category->delete();
    }

    public function categoryCreate($inputs)
    {
        return $this->startCondition()->create($inputs);
    }

}
