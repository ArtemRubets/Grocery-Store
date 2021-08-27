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
        $columns = ['id', 'category_name' , 'category_slug', 'parent_category'];
        return $this->startCondition()->where('parent_category' , 0)->excerptWithoutCategory()
            ->with('child')->get($columns);
    }

    public function getCategoriesListForDashboard(){
        $columns = ['id', 'category_name', 'category_slug', 'category_image', 'parent_category'];
        return  $this->startCondition()->with('child')->get($columns);
    }

    public function getCategoriesListForSelects(){
        $columns = ['id' , 'category_name'];
        return $this->startCondition()->get($columns);
    }

    public function getCategoriesListForProductCategories(){
        $columns = ['id' , 'category_name', 'category_slug', 'category_image'];
        return $this->startCondition()->get($columns);
    }

    public function getCategoriesListForCategories(){
        $columns = ['id' , 'category_name', 'category_slug', 'category_image'];
        return $this->startCondition()->excerptWithoutCategory()->get($columns);
    }

    public function getCategory($category_slug){
        $columns = ['id', 'category_name', 'category_image', 'category_slug', 'category_description'];
        return $this->startCondition()->where('category_slug' , $category_slug)
            ->excerptWithoutCategory()->firstOrFail($columns);
    }

    public function find($id){
        return $this->startCondition()->excerptWithoutCategory()->findOrFail($id);
    }

    public function findForProducts($id){
        return $this->startCondition()->findOrFail($id);
    }

    public function getWithoutCategory()
    {
        $columns = ['id', 'category_slug'];
        return $this->startCondition()->where('category_slug', 'without-category')->first($columns);
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
