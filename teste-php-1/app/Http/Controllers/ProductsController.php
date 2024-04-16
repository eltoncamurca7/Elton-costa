<?php

namespace App\Http\Controllers;

use App\helpers\FormatPrice;
use App\Http\Requests\ProductsRequest;
use App\Models\Products;
use App\Repository\Product\ProductRepository;
use Exception;
use Illuminate\Http\Request;

class ProductsController extends Controller
{

    private $productRepository;
    private $formatPrice;

    public function __construct(ProductRepository $productRepository, FormatPrice $formatPrice)
    {
        $this->productRepository = $productRepository;
        $this->formatPrice = $formatPrice;
    }

    public function index()
    {
        $products = $this->productRepository->all();
        return view('products.index', [ 'products' => $products]);
    }

    public function createProduct(ProductsRequest $request)
    {
        try {
            $data = $request->all();
            $data['unit_price'] = $this->formatPrice->formatUnitPrice($data['unit_price']);
            $this->productRepository->create($data);
            return redirect()->route('index-product');
        } catch (Exception $error) {
            return response()->json(['message' => 'Erro so registrar produto: ' . $error->getMessage()], 500);
        }
    }

    public function newProduct()
    {
        return view('products.create');
    }

    public function listProducts()
    {
        $products = $this->productRepository->all();
        return $products;
        // return view('products.index', ['products' => $products]);
    }

    public function deleteProduct($id)
    {
        try {
            $this->productRepository->delete($id);
            return redirect()->route('index-product');
        } catch (Exception $error) {
            return response()->json(['message' => 'Erro interno: ' . $error->getMessage()], 500);
        }
    }

    public function editProduct($id)
    {
        $product = $this->productRepository->find($id);
        $product->unit_price_formatted = number_format($product->unit_price, 2, ',', '.');
        return view('products.edit', ['product' => $product]);
    }

    public function updateProduct(Request $request)
    {
        try {
            $data = $request->all();
            $data['unit_price'] = $this->formatPrice->formatUnitPrice($data['unit_price']);
            $this->productRepository->update($data);
            return redirect()->route('index-product');
        } catch (Exception $error) {
            return response()->json(['message' => 'Erro ao atualizar produto: ' . $error->getMessage()], 500);
        }
    }

    public function detailsProduct($id)
    {
        try {
            $product = $this->productRepository->find($id);
            if (empty($product)) {
                return response()->json(['message' => 'Produto não encontrado'], 404);
            }
            return view('products.show', ['product' => $product]);
        } catch (Exception $error) {
            return response()->json(['error' => 'Erro interno no servidor'], 500);
        }
    }
    

    public function sortProducts($field)
    {
        $sort = Products::query();

        if ($field === 'id' || $field === 'name' || $field === 'email') {
            $sort->orderBy($field);
        }

        $clients = $sort->paginate(20);

        return view('clients.index', compact('clients'));
    }

}
