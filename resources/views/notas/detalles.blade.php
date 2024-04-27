@extends('layouts.formato')

@section('titulo', 'Detalles Nota')

<style>
    body {
        font-family: 'Lucida Calligraphy', sans-serif;
        background-color: #f0f0f0;
        margin: 0;
        display: flex;
        align-items: center;
        justify-content: center;
        height: 100vh;
    }

    .nota-container {
        text-align: center;
        width: 80%;
        margin: 20px auto;
        background-color: #fff;
        box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        border-radius: 8px;
        padding: 20px;
        position: relative; 
    }

    table {
        border-collapse: collapse;
        width: 100%;
        height: 200px;
    }

    td {
        padding: 10px;
        border-bottom: 1px solid #ddd;
        text-align: left;
    }

    td:last-child {
        border-bottom: none;
    }

    .color-box {
        display: inline-block;
        width: 20px;
        height: 20px;
        background-color: {{ $nota->color}};
    }

    .btn-volver {
        background-color: #3498db;
        color: #fff;
        border: 1px solid #3498db;
        padding: 10px 20px;
        border-radius: 50px;
        text-decoration: none;
        cursor: pointer;
        transition: background-color 0.3s ease;
    }

    .btn-volver:hover {
        background-color: #581845;
        color: beige;
        box-shadow: 
        0 0 5px #581845,
        0 0 20px #581845,
        0 0 60px #581845,
        0 0 150px #581845;
        transform: scale(1.1);
        opacity: 100%;
    }
</style>

@section('contenido')

<div class="nota-container">
    <h3>Detalle nota : "{{ $nota->titulo }}"</h3>

    <table>
        <tbody>
            <tr>
                <td>
                    <strong>Título:</strong> {{ $nota->titulo }} <br>
                    <strong>Contenido:</strong> {{ $nota->contenido }} <br>
                    <strong>Categoría:</strong> {{ $nota->categoria->nombre_categoria ?? 'Sin categoría' }} <br>
                    <strong>Color:</strong> <span class="color-box"></span> <br>
                </td>
                <td>
                    <strong>Fecha de Creación:</strong> {{ $nota->fecha_creacion }} <br>
                    <strong>Etiqueta:</strong> {{ $nota->etiqueta ?? 'No hay etiqueta' }} <br>
                </td>
            </tr>
        </tbody>
    </table>

    <a href="{{ route('notas.notaspersonal') }}" class="btn-volver">Volver</a>
</div>

@endsection