@extends('layouts.app')

@section('title','Edição')

@section('content')
    <div class="container mt-5">
        <h1>Editar Cliente</h1>
        <hr>
        <form action="/update-client" method="POST">
            @csrf
            @method('PUT')
            <input type="hidden" name="id" value="{{ $client->id }}">
            <div class="form-grup">
                <div class="form-group">
                    <label for="nome"><b>Nome:</b></label>
                    <input type="text" class="form-control" name="name" value="{{ $client->name }}" placeholder="Digite um nome ...">
                </div>
                <br>
                <div class="form-group">
                    <label for="cpf"><b>CPF:</b></label>
                    <input type="text" class="form-control" name="cpf" value="{{ $client->cpf }}" placeholder="Digite o seu cpf..." disabled>
                </div>
                <br>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="text" class="form-control" name="email" value="{{ $client->email }}" placeholder="Digite o seu email...">
                </div>
                <br>
                <div class="form-group">
                    <input type="submit" name="submit" class="btn btn-success" value="Atualizar">
                </div>                
            </div>
        </form>
    </div>
@endsection
