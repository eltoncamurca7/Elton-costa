<?php

namespace App\Repository\Order;

use App\Models\Order;

class OrderRepository
{

    private $orderModel;

    public function __construct(Order $orderModel)
    {
        $this->orderModel = $orderModel;
    }

    public function all()
    {
        return Order::select('orders.*', 'clients.name as client_name', 'orders_products.quantity')
            ->join('clients', 'orders.client_id', '=', 'clients.id')
            ->join('orders_products', 'orders.id', '=', 'orders_products.orders_id')
            ->paginate(20);
    }

    public function find($id)
    {
        return $this->orderModel->find($id);
    }

    public function create($data)
    {
        return $this->orderModel->create($data);
    }

    public function update($data)
    {
        dd($data);
        return $this->orderModel->find($data['id'])->update($data);
    }

    public function delete($id)
    {
        return $this->orderModel->find($id)->delete();
    }
}
