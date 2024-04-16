@extends('layouts.app')

@section('title','Cadastro')

@section('content')
<div class="container mt-5">
    <h1>Cadastrar Novo Produto</h1>
    <hr>
    @csrf
    <div class="form-grup">
        <div class="form-group">
            <label for="produtoNome">Nome Do Produto:</label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Nome do produto...">
        </div>
        <br>
        <div class="form-group">
            <label for="produtoCodigo">Código de barras:</label>
            <input type="number" class="form-control" name="barcode" id="barcode" placeholder="000000">
        </div>
        <br>
        <div class="form-group">
            <label for="produtoValor">Valor:</label>
            <input type="text" class="form-control" name="unit_price" id="unit_price" placeholder="0,00" pattern="[0-9]+(,[0-9]+)?">
        </div>
        <br>
        <div class="form-group">
            <button onclick="create()" class="btn btn-primary">Enviar</button>
        </div>
    </div>
</div>

<script>
    function create() {

        const myHeaders = new Headers();
        myHeaders.append("Accept", "application/json");
        myHeaders.append("Content-Type", "application/json");


        let name = document.getElementById("name").value;
        let barcode = document.getElementById("barcode").value;
        let unit_price = document.getElementById("unit_price").value;

        const data = JSON.stringify({
            "name": name,
            "barcode": barcode,
            "unit_price": unit_price
        });


        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: data,
            redirect: "follow"
        };

        fetch("/create-product", requestOptions)
            .then((response) => {
                if (!response.ok) {
                    return response.json();
                } else {
                    window.location.href = '/index-product'
                }
            })
            .then((data) => {

                alert(data.message);
            })
            .catch((error) => {
                console.error('Erro ao fazer a requisição:', error);
            });

    }
</script>

@endsection