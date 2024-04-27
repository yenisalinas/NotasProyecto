@extends('layouts.formato')

@section('titulo', 'Notas')

<style>
    body {
        display: flex;
        justify-content: center;
        align-items: center;
        height: 100vh;
        margin: 0;
        background-color: #2ecc71; 
    }

    form {
        background-color: #ecf0f1; 
        padding: 40px; 
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        width: 400px;
        text-align: center; 
        margin: auto; 
    }

    h2 {
        color: #3498db; 
    }

    label {
        display: block;
        margin: 10px 0;
        font-weight: bold;
        color: #555; 
    }

    input {
        width: 100%;
        padding: 8px;
        margin-bottom: 10px;
        border: 1px solid #3498db;
        border-radius: 5px;
        box-sizing: border-box;
    }

    button {
        background-color: #3498db;
        color: #fff;
        padding: 10px 15px;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 100%; 
    }

    button:hover {
        background-color: #2980b9; 
    }
</style>

@section('contenido')
<form method="post" action="{{ route('categorias.store')}}">
@csrf
    <h2>Crear Nueva Categoría</h2>
    <label for="categoria">Nombre de la Categoría:</label>
    <input type="text" id="newcategoria" name="newcategoria">
    <p></p>
    <button type="submit">Crear Categoría</button>
</form>
@endsection
