<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoryRepositoryInterface;
use App\Interfaces\IOrderRepositoryInterface;
use App\Interfaces\IProductRepositoryInterface;

class OrderController extends MainController
{

    private $productRepository;
    private $orderRepository;


    public function __construct(IProductRepositoryInterface $productRepository ,
                                ICategoryRepositoryInterface $categoryRepository,
                                IOrderRepositoryInterface $orderRepository){
        parent::__construct($categoryRepository);

        $this->productRepository = $productRepository;
        $this->orderRepository = $orderRepository;
    }



}
