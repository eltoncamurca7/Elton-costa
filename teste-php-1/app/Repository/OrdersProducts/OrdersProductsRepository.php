<?php

namespace App\Repository\OrdersProducts;

use App\Models\OrdersProducts;

class OrdersProductsRepository
{
    private $OrdersProductsModel;

    public function __construct(OrdersProducts $OrdersProductsModel)
    {
        $this->OrdersProductsModel = $OrdersProductsModel;
    }

    public function create($data)
    {

        return $this->OrdersProductsModel->create($data);
    }
}
