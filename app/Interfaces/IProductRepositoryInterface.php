<?php


namespace App\Interfaces;


use Illuminate\Database\Eloquent\Collection;

interface IProductRepositoryInterface
{

    public function getModel();

    public function getCategoryProducts($category);

    public function getCategoryProductsForDashboard($category);

    public function getProduct($product_slug);

    public function getProductForDashboard($id);

    public function find($id);

    public function getTrashedProducts();

    public function productRestore($id);

    public function productUpdate($product, $validatedInputs);

    public function productStore($validatedInputs);

    public function forceDelete($id);

    public function getPrice($product);

    public function searchProducts($searchQuery);
}
