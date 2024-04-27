@extends('layouts.formato')

@section('titulo', 'Notas')
<style>
    .card {
        border: none;
        border-radius: 20px;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15), 0 0 0 10px rgba(255, 255, 255, 0.2);
        margin: 5px;
    }
    .card:hover {
        transform: scale(1.1);
        box-shadow: 
        0 0 5px #f3b5c5,
        0 0 20px #f3b5c5,
        0 0 60px #f3b5c5,
        0 0 150px #f3b5c5;

    }
    .card-body {
        border: none;
        border-top-left-radius: 20px;
        padding: 20px;
        height: auto;
        box-shadow: 0 4px 8px rgba(0, 0, 0, 0.15), 0 0 0 10px rgba(255, 255, 255, 0.2);
    }

    .note-title {
        font-size: 20px;
        font-weight: bold;
    }

    .note-info {
        font-size: 14px;
        color: #666;
    }

    .btns {
        margin-top: auto;
    }

    .btn-primary {
        background-color: #007bff;
        color: white;
        border: 1px solid transparent;
        border-radius: 5px;
        padding: 8px 15px;
        text-decoration: none;
        display: inline-block;
        margin-right: 10px;
        transition: background-color 0.3s ease;
    }

    .btn-primary:hover {
        background-color: #581845;
        color: white;
        box-shadow: 
        0 0 5px #581845,
        0 0 20px #581845,
        0 0 60px #581845,
        0 0 150px #581845;
        transform: scale(1.1);
        opacity: 100%;
        }

    input.form-control {
        background-color: transparent;
        border: none;
        border-bottom: 1px solid #ddd;
        margin-bottom: 10px;
        padding: 5px;
    }
    
    b{
        font-size: 25px;
        margin-left: 50px;
    }
</style>

@section('contenido')

@if(session('mensaje'))
<div class="alert alert-success" role="alert">
    {{ session('mensaje') }}
</div>
@endif
<div>
    <form method="get">
        <div class="row">
            <div class="col-2">
                <label for="categoria_id"><b>Categorías:</b></label>
            </div>
            <div class="col-6">
                <select name="categoria_id" id="categoria_id" class="form-control">
                    <option value="">----</option>
                    <option value="">De trabajo</option>
                    <option value="">De la escuela</option>
                    @foreach($categorias as $categoria)
                        <option value="{{ $categoria->id }}" {{ (request('categoria_id') == $categoria->id) ? 'selected' : '' }}>
                            {{ $categoria->nombre_categoria }}
                        </option>
                    @endforeach
                </select>
            </div>
            <div class="col-2">
                <button type="submit" class="btn btn-primary">Actualizar</button>
            </div>
            <div class="col-2">
                <span><a class="btn btn-primary" href="{{ route('categorias.create') }}">Nueva Categoria</a></span>
            </div>
        </div>
    </form>
</div>

@if(request()->has('categoria_id'))
    @php
        $categoriaSeleccionada = $categorias->firstWhere('id', request('categoria_id'));
    @endphp

    @if($categoriaSeleccionada)
        <h3>Notas de la categoría: {{ $categoriaSeleccionada->nombre_categoria }}</h3> <p></p>

        <div class="row">
            @forelse($categoriaSeleccionada->notas as $nota)
                <div class="col-4 mb-3">
                    <div class="card" style="background-color: {{$nota->color}}">
                        <div class="card-body">
                            <table>
                                <tbody>
                                    <tr>
                                        <td>
                                            <h5 class="note-title">{{$nota->titulo}}</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <p class="note-info">#{{$nota->etiqueta}}</p>
                                        </td>
                                    </tr>
                                    <tr>
                                        <td>
                                        <div class="btns">
                                            <a href="{{ route('notas.edit', $nota->id) }}" class="btn btn-primary">Editar</a>
                                            <form action="{{ route('notas.destroy', $nota->id) }}" method="post" style="display: inline-block;">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-primary" onclick="return confirm('¿Estás seguro de que quieres eliminar esta nota?')">Eliminar</button>
                                            </form>
                                            <a href="{{ route('notas.show', $nota->id) }}" class="btn btn-primary">Detalles</a>
                                        </div>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            @empty
                <div class="col-12">
                    <p>No hay notas disponibles</p>
                </div>
            @endforelse
        </div>
    @endif
@endif

@endsection