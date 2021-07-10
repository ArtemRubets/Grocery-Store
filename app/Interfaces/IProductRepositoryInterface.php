<?php


namespace App\Interfaces;


interface IProductRepositoryInterface
{

    public function getModel();

    public function getCategoryProducts($category);

    public function getProduct($product_slug);

    public function getProductForDashboard($id);

    public function find($id);

    public function getTrashedProducts();

    public function productRestore($id);

    public function forceDelete($id);
}
