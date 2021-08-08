<?php


namespace App\Interfaces;


interface ICategoryRepositoryInterface
{
    public function getModel();

    public function getCategoriesList();

    public function getCategoriesListForDashboard();

    public function getCategoriesListForSelects();

    public function getCategoriesListForProductCategories();

    public function getCategoriesListForCategories();

    public function getCategory($category_slug);

    public function find($id);

    public function findForProducts($id);

    public function getWithoutCategory();

    public function categoryDelete($category);

    public function categoryCreate($inputs);
}
