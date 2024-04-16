@extends('layouts.app')

@section('title','Cadastro')

@section('content')



<div class="container mt-5">
    <div class="row">
        <div class="col-sm-12">
            <h1>Escolha os produtos</h1>
        </div>
    </div>
    <div class="row">
        <label class="mt-4" for="produtoNome"><b>Selecione um Cliente:</b></label>
        <div class="form-group col-sm-6">
            <select name="client_id" class="form-control" id="client_id">
                <option value="0" disabled selected>Selecione</option>
                @foreach ($clients as $client)
                <option value="{{ $client->id }}">{{ $client->name }}</option>
                @endforeach
            </select>
        </div>
        <label class="mt-4" for="produtoNome"><b>Selecione um Produto:</b></label>
        <div class="form-group col-sm-4">
            <select name="product_id" class="form-control" id="product_id">
                <option value="0" disabled selected>Selecione</option>
                @foreach ($products as $product)
                <option value="{{ $product }}">{{ $product->name }}</option>
                @endforeach
            </select>
        </div>
        <label class="mt-4" for="quantity"><b>Quantidade:</b></label>
        <div class="form-group col-sm-4">
            <input type="number" class="form-control" id="quantity" name="quantity" placeholder="0">
        </div>
        <div class="form-group col-sm-2">
            <button onclick="addProducts()" id="btn-next" class="btn btn-success btn-add">Adicionar produto</button>
        </div>
        <div class="form-group col-sm-8 mt-4">
            <label for="desconto"><b>Desconto %:</b></label>
            <input type="number" class="form-control" id="discount" name="discount" placeholder="0">
        </div>
    </div>
    <br>
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">ID</th>
                <th scope="col"><a>Quantidade</a></th>
                <th scope="col"><a>Nome do produto</a></th>
                <th scope="col"><a>Valor unitario</a></th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="products-table-body">
        </tbody>
    </table>
    <div class="totalValue">
        <label for=""><b>Valor Total</b> R$ <span id="value"><b>0.00</b></span></label>
    </div>

    <br>
    <button onclick="addOrders()" id="btn-next" class="btn btn-success btn-add">Adicionar</button>
</div>



<script>
    var productsArray = [];
    var tableBody = document.getElementById("products-table-body");
    var total = 0;

    function addProducts() {

        if (verifyImput()) {
            var product = JSON.parse(document.getElementById("product_id").value);
            var quantity = document.getElementById("quantity").value;
            var productData = {
                id: product.id,
                name: product.name,
                unit_price: product.unit_price,
                quantity: quantity
            };
            productsArray.push(productData);

            var newRow = tableBody.insertRow();
            var cellId = newRow.insertCell(0);
            var cellQuantity = newRow.insertCell(1);
            var cellName = newRow.insertCell(2);
            var cellUnitPrice = newRow.insertCell(3);
            var cellActions = newRow.insertCell(4);

            cellId.innerHTML = productData.id;
            cellName.innerHTML = productData.name;
            cellQuantity.innerHTML = quantity;
            cellUnitPrice.innerHTML = productData.unit_price;
            cellActions.innerHTML = "<button class='btn btn-danger btn-sm'>Remover</button>";

            total = productsArray.reduce((acc, curr) => acc + (curr.unit_price * curr.quantity), 0);

            document.getElementById("product_id").value = 0;
            document.getElementById("quantity").value = '';

            sumTotalValue();
        }
    }

    function addOrders() {
        if (productsArray.length === 0) {
            alert('Adicione no minimo um produto');
            return;
        }

        var client_id = document.getElementById("client_id").value;
        var discount = document.getElementById("discount").value;

        if (!client_id) {
            alert('Selecione um cliente');
            return;
        }

        if (!discount) {
            alert('Informe o desconto');
            return;
        }

        var discountAmount = (total * (discount / 100));
        var totalWithDiscount = total - discountAmount;

        var order = {
            client_id: client_id,
            discount: discount,
            total_value: totalWithDiscount.toFixed(2),
            products: productsArray.map(product => ({
                product_id: product.id,
                quantity: product.quantity
            }))
        };

        fetch('/resgister-order', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                },
                body: JSON.stringify(order),
            })
            .then(response => {
                console.log(response)
                if (response.ok) {
                    return response.json();
                }
                throw new Error('Erro ao enviar pedido');
            })
            .then(data => {
                console.log(data);
                productsArray = [];
                tableBody.innerHTML = '';
                total = 0;
                sumTotalValue();
                alert('Pedido registrado com sucesso');
                window.location.href = '/index-order'
            })
            window.location.href = '/index-order'
    }

    function verifyImput() {

        if (document.getElementById("client_id").value == 0) {
            alert('Selecione um cliente')
            return false
        }
        if (document.getElementById("product_id").value == 0) {
            alert('Selecione um produto')
            return false
        }
        if (document.getElementById("quantity").value == '') {
            alert('Informe a quantidade')
            return false
        }
        return true
    }

    function sumTotalValue() {
        document.getElementById('value').textContent = total.toFixed(2);
    }
</script>

@endsection