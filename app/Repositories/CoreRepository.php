<?php


namespace App\Repositories;


abstract class CoreRepository
{
    private $model;

    public function __construct(){
        $this->model = app($this->getModel());
    }

    abstract protected function getModel();

    public function startCondition(){
        return clone $this->model;
    }


}
