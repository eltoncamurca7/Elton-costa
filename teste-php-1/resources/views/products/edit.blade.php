@extends('layouts.app')

@section('title','Cadastro')

@section('content')
<div class="container mt-5">
    <h1>Cadastrar Novo Produto</h1>
    <hr>
    <form action="/update-product" method="POST">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="form-grup">
            <div class="form-group">
                <label for="produtoNome">Nome Do Produto:</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nome do produto...">
            </div>
            <br>
            <div class="form-group">
                <label for="produtoCodigo">Código de barras:</label>
                <input type="number" class="form-control" name="barcode" value="{{ $product->barcode }}" placeholder="000000">
            </div>
            <br>
                <label for="produtoValor">Valor:</label>
                <input type="text" class="form-control" id="unit_price" name="unit_price" value="{{ number_format($product->unit_price, 2, ',', '.') }}">
            </div>
            <br>
            <div class="form-group">
                <input type="submit" name="submit" class="btn btn-primary">
            </div>
        </div>
    </form>
</div>
@endsection