<?php


namespace App\Repositories;


use App\Interfaces\ICategoryRepositoryInterface;
use App\Models\Category;

class CategoryRepository extends CoreRepository implements ICategoryRepositoryInterface
{
    public function getModel(){
        return Category::class;
    }

    public function getCategoriesList(){
        return $this->startCondition()->where('parent_category' , 0)
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
        return $this->startCondition()->get(['id' , 'category_name', 'category_image']);
    }

    public function getCategoriesListForCategories(){
        return $this->startCondition()->get(['id' , 'category_name', 'category_slug', 'category_image']);
    }

    public function getCategory($category_slug){
        return $this->startCondition()->where('category_slug' , $category_slug)->firstOrFail();
    }

    public function find($id){
        return $this->startCondition()->findOrFail($id);
    }
}
