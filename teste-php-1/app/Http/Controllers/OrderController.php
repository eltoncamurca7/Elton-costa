<?php

namespace App\Http\Controllers;

use App\Repository\Client\ClientRepository;
use App\Repository\Order\OrderRepository;
use App\Repository\OrdersProducts\OrdersProductsRepository;
use App\Repository\Product\ProductRepository;
use Exception;
use Illuminate\Http\Request;

class OrderController extends Controller
{

    private $ordeRepository;
    private $clienteRepository;
    private $productsRepository;
    private $ordersProductsRepository;

    public function __construct(
        OrderRepository $ordeRepository,
        ClientRepository $clienteRepository,
        ProductRepository $productsRepository,
        OrdersProductsRepository $ordersProductsRepository
    ) {
        $this->ordeRepository = $ordeRepository;
        $this->clienteRepository = $clienteRepository;
        $this->productsRepository = $productsRepository;
        $this->ordersProductsRepository = $ordersProductsRepository;
    }

    public function index()
    {
        $orders = $this->ordeRepository->all();
        return view('orders.index', ['orders' => $orders]);
    }

    public function registerOrders(Request $request)
    {
        try {
            $data = json_decode(json_encode($request->all()));
            $arrayOrder = [
                "client_id" => intval($data->client_id),
                "discount" => intval($data->discount),
                "total_value" => floatval($data->total_value)
            ];
            $order = $this->ordeRepository->create($arrayOrder);
            foreach ($data->products as $item) {

                $arrayOrderProduct =
                    [
                        'product_id' => intval($item->product_id),
                        'orders_id' => $order->id,
                        'quantity' => intval($item->quantity),
                    ];

                $this->ordersProductsRepository->create($arrayOrderProduct);
            }
        } catch (Exception $e) {
            dd($e->getMessage());
            return response()->json(['message' => 'Erro ao registrar pedido: ' . $e->getMessage()], 500);
        }
    }

    public function newOrders()
    {
        $clients = $this->clienteRepository->all();
        $products = $this->productsRepository->all();
        return view('Orders.create', ['clients' => $clients, 'products' => $products]);
    }

    public function listOrders()
    {
        $orders = $this->ordeRepository->all();
        return view('orders.index', ['orders' => $orders]);
    }


    public function upsateStatusOrders(Request $request)
    {
        dd($request);
        try {
            $data = $request->all();
            dd($data);
            $this->ordeRepository->update($data['status']);
            return response()->json(['status' => 'success', 'message' => 'Status atualizado com sucesso']);
        } catch (Exception $error) {
            return response()->json(['status' => 'error', 'message' => 'Erro ao atualizar status do pedido: ' . $error->getMessage()], 500);
        }
    }
}
