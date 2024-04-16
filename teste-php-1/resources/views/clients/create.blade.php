@extends('layouts.app')

@section('title','Cadastro')

@section('content')
<div class="container mt-5">
    <h1>Cadastrar Novo Cliente</h1>
    <hr>


    <div class="form-grup">
        @csrf
        <div class="form-group">
            <label for="nome"><b>Nome:</b></label>
            <input type="text" class="form-control" name="name" id="name" placeholder="Digite um nome ..." > 
        </div>
        <br>
        <div class="form-group">
            <label for="cpf"><b>CPF:</b></label>
            <input type="text" class="form-control" name="cpf" id="cpf" placeholder="Digite o seu cpf...">
        </div>
        <br>
        <div class="form-group">
            <label for="email"><b>Email:</b></label>
            <input type="email" class="form-control" name="email" id="email" placeholder="Digite o seu email...">
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
        let cpf = document.getElementById("cpf").value;
        let email = document.getElementById("email").value;

        const data = JSON.stringify({
            "name": name,
            "cpf": cpf,
            "email": email
        });


        const requestOptions = {
            method: "POST",
            headers: myHeaders,
            body: data,
            redirect: "follow"
        };

        fetch("/create-client", requestOptions)
            .then((response) => {
                if (!response.ok) {
                    return response.json();
                } else {
                    window.location.href = '/index-client'
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