<?php


namespace App\Interfaces;


interface IProductRepositoryInterface
{

    public function getModel();

    public function getCategoryProducts($category, $currencyId);

    public function getProduct($product_slug,$currencyId);

    public function getProductForDashboard($id);

    public function find($id);

    public function getTrashedProducts();

    public function productRestore($id);

    public function forceDelete($id);

    public function getPrice($product, $currencyId);
}
