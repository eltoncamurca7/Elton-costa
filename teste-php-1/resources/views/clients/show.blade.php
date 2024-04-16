@extends('layouts.app')

@section('title','Edição')

@section('content')
    <div class="container mt-5">
        <h1>Detalhes do Cliente</h1>
        <hr>
        <form action="#">
            @csrf
            <div class="form-grup">
                <div class="form-group">
                    <label for="nome"><b>Nome:</b></label>
                    <input type="text" class="form-control" name="nome" value="{{ $client->name }}"  disabled>
                </div>
                <br>
                <div class="form-group">
                    <label for="cpf"><b>CPF:</b></label>
                    <input type="text" class="form-control" name="cpf" value="{{ $client->cpf }}" disabled>
                </div>
                <br>
                <div class="form-group">
                    <label for="email"><b>Email:</b></label>
                    <input type="text" class="form-control" name="email" value="{{ $client->email }}" disabled>
                </div>               
            </div>
        </form>
    </div>
@endsection
