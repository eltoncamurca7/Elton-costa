<?php

namespace App\Repository\Client;

use App\Models\Client;

class ClientRepository
{

    private $clientModel;

    public function __construct(Client $clientModel)
    {
        $this->clientModel = $clientModel;
    }

    public function all()
    {
        return $this->clientModel->orderBy('created_at', 'desc')->paginate(20);
    }

    public function find($id)
    {
        return $this->clientModel->find($id);
    }

    public function create($data)
    {
        return $this->clientModel->create($data);
    }

    public function delete($id)
    {
        return $this->clientModel->find($id)->delete();
    }

    public function update($data)
    {
        return $this->clientModel->find($data['id'])->update($data);
    }

    public function deleteSelected(array $ids)
    {
        return $this->clientModel->whereIn('id', $ids)->delete();
    }
}
