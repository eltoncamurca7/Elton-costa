@extends('layouts.app')

@section('title', 'Pedidos')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-10">
            <h1>Listar Pedidos</h1>
        </div>
        <div class="col-sm-2">
            <a href="{{ route('new-order') }}" class="btn btn-success">Novo Pedido</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-4">
            <input type="text" id="filterInput" class="form-control" placeholder="Filtrar por numero">
        </div>
    </div>
    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col">Status</th>
                <th scope="col">Numero do Pedido</th>
                <th scope="col">Data de criação</th>
                <th scope="col">Cliente</th>
                <th scope="col">Quant.</th>
                <th scope="col">Desconto</th>
                <th scope="col">Valor Total</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="table-orders">
            @foreach ($orders as $order)
            <tr>
                <th>{{ $order->status }}</th>
                <th>{{ $order->id }}</th>
                <th>{{ $order->created_at->format('d/m/Y') }}</th>
                <th>{{ $order->client_name }}</th>
                <th>{{ $order->quantity }}</th>
                <th>{{ $order->discount }} %</th>
                <th>{{ $order->total_value }}</th>
                <th class="d-flex">
                    <select id="statusSelect" onchange="updateStatus(this)" data-order-id="{{ $order->id }}">
                        <option value="Aberto" {{ $order->status == 'Aberto' ? 'selected' : '' }}>Aberto</option>
                        <option value="Cancelado" {{ $order->status == 'Cancelado' ? 'selected' : '' }}>Cancelado</option>
                        <option value="Pago" {{ $order->status == 'Pago' ? 'selected' : '' }}>Pago</option>
                    </select>

                </th>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $orders->links('pagination::bootstrap-4') }}
</div>

<script>
    const inputFilter = document.getElementById('filterInput');
    const tableOrders = document.getElementById('table-orders');

    inputFilter.addEventListener('keyup', () => {
        let expression = inputFilter.value.toLowerCase();
        let rows = tableOrders.getElementsByTagName('tr');

        for (let row of rows) {
            let orderId = row.getElementsByTagName('th')[1].textContent.toLowerCase();
            if (orderId.includes(expression)) {
                row.style.display = '';
            } else {
                row.style.display = 'none';
            }
        }
    });

    // function updateStatus(select) {
    //     var status = select.value;
    //     var orderId = select.getAttribute('data-order-id');
    //     var data = {
    //         status: status
    //     };
    //     fetch('/update-status-orders/' + orderId, {

    //             method: 'POST',
    //             headers: {
    //                 'Content-Type': 'application/json',
    //                 'X-CSRF-TOKEN': '{{ csrf_token() }}'
    //             },
    //             body: JSON.stringify(data)
    //         })
    //         .then(response => {

    //             if (response.ok) {
    //                 console.log('Status atualizado com sucesso');
    //             } else {
    //                 console.error('Falha ao atualizar status');
    //             }
    //         })
    //         .catch(error => {
    //             console.error('Erro ao atualizar status:', error);
    //         });
    // }
</script>

@endsection