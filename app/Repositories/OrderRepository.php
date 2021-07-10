<?php


namespace App\Repositories;


use App\Interfaces\IOrderRepositoryInterface;
use App\Models\Order;

class OrderRepository extends CoreRepository implements IOrderRepositoryInterface
{

    public function getModel()
    {
        return Order::class;
    }
}
