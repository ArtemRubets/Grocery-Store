<?php

namespace App\Http\Controllers;

use App\Interfaces\ICategoryRepositoryInterface;

class MainController extends Controller
{
    public $categoryRepository;

    public function __construct(ICategoryRepositoryInterface $categoryRepository){
        $this->categoryRepository = $categoryRepository;
    }

    public function getCategoriesList(){
        return $this->categoryRepository->getCategoriesList();
    }
}
