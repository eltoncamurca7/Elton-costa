@extends('layouts.app')

@section('title', 'Listagem de Clientes')

@section('content')
<div class="container mt-5">
    <div class="row">
        <div class="col-sm-10">
            <h1>Listar Clientes</h1>
        </div>
        <div class="col-sm-2">
            <a href="{{ route('new-client') }}" class="btn btn-success">Novo Cliente</a>
        </div>
    </div>
    <div class="row mt-3">
        <div class="col-sm-4">
            <input type="text" id="filterInput" class="form-control" placeholder="Filtrar por nome">
        </div>
    </div>

    <table class="table mt-3">
        <thead>
            <tr>
                <th scope="col"><a href="{{ route('sort-clients', 'id') }}">ID</a></th>
                <th scope="col"><a href="{{ route('sort-clients', 'name') }}">Nome</a></th>
                <th scope="col"><a href="{{ route('sort-clients', 'email') }}">Email</a></th>
                <th scope="col">Ações</th>
            </tr>
        </thead>
        <tbody id="table-clients">
            @foreach ($clients as $client)
            <tr>
                <td>{{ $client->id }}</td>
                <td>{{ $client->name }}</td>
                <td>{{ $client->email }}</td>
                <td class="d-flex">
                    <a href="{{ route('edit-client', $client->id) }}" class="btn btn-primary me-2">
                        <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil-square" viewBox="0 0 16 16">
                            <path d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                            <path fill-rule="evenodd" d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5z" />
                        </svg>
                    </a>
                    <form action="/delete-client/{{ $client->id }}" method="POST" class="me-2">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">
                            <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-trash-fill" viewBox="0 0 16 16">
                                <path d="M2.5 1a1 1 0 0 0-1 1v1a1 1 0 0 0 1 1H3v9a2 2 0 0 0 2 2h6a2 2 0 0 0 2-2V4h.5a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H10a1 1 0 0 0-1-1H7a1 1 0 0 0-1 1zm3 4a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 .5-.5M8 5a.5.5 0 0 1 .5.5v7a.5.5 0 0 1-1 0v-7a.5.5 0 0 1 1 0" />
                            </svg>
                        </button>
                    </form>
                    <a href="{{ route('details-client', $client->id) }}" class="btn btn-warning"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-eye-fill" viewBox="0 0 16 16">
                            <path d="M10.5 8a2.5 2.5 0 1 1-5 0 2.5 2.5 0 0 1 5 0" />
                            <path d="M0 8s3-5.5 8-5.5S16 8 16 8s-3 5.5-8 5.5S0 8 0 8m8 3.5a3.5 3.5 0 1 0 0-7 3.5 3.5 0 0 0 0 7" />
                        </svg>
                    </a>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>

    {{ $clients->links('pagination::bootstrap-4') }}

</div>

<script>
    const inputFilter = document.getElementById('filterInput');
    const tableProducts = document.getElementById('table-clients');

    inputFilter.addEventListener('keyup', () => {
        let expression = inputFilter.value.toLowerCase();
        let lines = tableProducts.getElementsByTagName('tr');

        for (let position in lines) {
            if (true === isNaN(position)) {
                continue;
            }
            let conteudoDaLinha = lines[position].innerHTML.toLowerCase();
            if (true === conteudoDaLinha.includes(expression)) {
                lines[position].style.display = '';
            } else {
                lines[position].style.display = 'none';
            }
        }
    });
</script>


@endsection