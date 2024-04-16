@extends('layouts.app')

@section('title','Produtos')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-10">
            <h1>Listar produtos</h1>
        </div>
        <div class="col-sm-2">
            <a href="{{route('new-product')}}" class="btn btn-success">Novo Produto</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-4">
            <input type="text" id="filterInput" class="form-control" placeholder="Filtrar por nome do produto">
        </div>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col"></th>
                <th scope="col"><a href="{{ route('sort-products', 'id') }}">ID</th>
                <th scope="col"><a href="{{ route('sort-products', 'barcode') }}">codigo de barras</th>
                <th scope="col"><a href="{{ route('sort-products', 'name') }}">Nome</th>
                <th scope="col"><a href="{{ route('sort-products', 'unit_price') }}">Valor unitario</th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="table-products">

            @foreach ($products as $product)
            <tr>
                <td><input type="checkbox" name="ids[]" value="{{ $product->id }}"></td>
                <th>{{ $product->id }}</th>
                <th>{{ $product->barcode }}</th>
                <th>{{ $product->name }}</th>
                <th>{{ $product->unit_price }}</th>
                <th class="d-flex">
                    <a href="{{ route('edit-product', $product->id) }}" class="btn btn-primary me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </a>
                    <form action="/delete-product/{{ $product->id }}" method="POST" class="me-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7A.5.5 0 0 1 8 5m3 .5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                            </svg>
                        </button>
                    </form>
                    <a href="{{ route('details-product', $product->id) }}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg>
                    </a>

                </th>
            </tr>
            @endforeach

        </tbody>
    </table>
    {{ $products->links('pagination::bootstrap-4') }}
</div>

<script>
    const inputFilter = document.getElementById('filterInput');
    const tableProducts = document.getElementById('table-products');

    inputFilter.addEventListener('keyup', () => {
        let expression = inputFilter.value.toLowerCase();
        let lines = tableProducts.getElementsByTagName('tr');

        for (let position in lines) {
            if (true === isNaN(position)) {
                continue;
            }
            let LineContent = lines[position].innerHTML.toLowerCase();
            if (true === LineContent.includes(expression)) {
                lines[position].style.display = '';
            } else {
                lines[position].style.display = 'none';
            }
        }
    });
</script>
@endsection