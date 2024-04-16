<?php

namespace App\Repository\Product;

use App\Models\Products;

class ProductRepository
{
    private $productModel;

    public function __construct(Products $productModel)
    {
        $this->productModel = $productModel;
    }

    public function all()
    {
        return $this->productModel->orderBy('created_at', 'desc')->paginate(20);
    }

    public function find($id)
    {
        return $this->productModel->find($id);
    }

    public function create($data)
    {
        return $this->productModel->create($data);
    }

    public function update($data)
    {
        return $this->productModel->find($data['id'])->update($data);
    }

    public function delete($id)
    {
        return $this->productModel->find($id)->delete();
    }
}
