@extends('layouts.app')

@section('title','Cadastro')

@section('content')
<div class="container mt-5">
    <h1>Detalhes do Produto</h1>
    <hr>
    <form action="#">
        @csrf
        @method('PUT')
        <input type="hidden" name="id" value="{{ $product->id }}">
        <div class="form-grup">
            <div class="form-group">
                <label for="produtoNome">Nome Do Produto:</label>
                <input type="text" class="form-control" name="name" value="{{ $product->name }}" placeholder="Nome do produto..." disabled>
            </div>
            <br>
            <div class="form-group">
                <label for="produtoCodigo">Código de barras:</label>
                <input type="number" class="form-control" name="barcode" value="{{ $product->barcode }}" placeholder="000000" disabled>
            </div>
            <br>
            <div class="form-group">
                <label for="produtoValor">Valor:</label>
                <input type="number" class="form-control" name="unit_price" value="{{ $product->unit_price }}" placeholder="0,00" disabled>
            </div>
        </div>
    </form>
</div>
@endsection