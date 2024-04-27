<?php

namespace App\Http\Controllers;

use App\Models\Categoria;
use App\Models\Nota;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $notas = Nota::where('user_id', $user->id)->paginate(10);
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('notas.notaspersonal', compact('notas', 'categorias'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('notas.nuevanota', compact('categorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        
        $request->validate([
            'titulo'=>'required',
            'contenido'=>'required',
            'etiqueta'=>'regex:/[A-Za-z]+$/i',
        ]);

        $user = Auth::user();
        $nuevaNota = new Nota();
        $nuevaNota->titulo = $request->input('titulo');
        $nuevaNota->contenido = $request->input('contenido');
        $nuevaNota->fecha_creacion = $request->input('fecha');
        $nuevaNota->etiqueta = $request->input('etiqueta');
        $nuevaNota->color = $request->input('color');
        $nuevaNota->categoria_id = $request->input('categoria_id');
        $nuevaNota->user_id = $user->id;
        
        if($nuevaNota->save()){
            return redirect()->route('notas.notaspersonal')->with('mensaje', '¡Nota guardada!');
        }
        else{
            return redirect()->route('notas.notaspersonal')->with('mensaje', 'Error, la nota no se guardo');
        }
    }
    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        
        $nota = Nota::findOrFail($id);
        return view('notas.detalles')->with('nota', $nota);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $nota = Nota::findOrFail($id);
        $categorias = Categoria::where('user_id', Auth::id())->get();
        return view('notas.nuevanota', compact('nota', 'categorias'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $nota = Nota::findOrFail($id);

        $request->validate([
            'titulo' => 'required',
            'fecha' => 'required',
            'contenido' => 'required',
            'etiqueta' => 'nullable|string',
        ]);

        $nota->titulo = $request->input('titulo');
        $nota->contenido = $request->input('contenido');
        $nota->fecha_creacion = $request->input('fecha');
        $nota->etiqueta = $request->input('etiqueta');
        $nota->color = $request->input('color');
        $nota->categoria_id = $request->input('categoria_id');

        $nota->save();

        return redirect()->route('notas.notaspersonal')->with('mensaje', 'Nota actualizada con éxito');
        }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (Nota::destroy($id) > 0) {
            return redirect()->route('notas.notaspersonal')->with('mensaje', 'Nota borrada con exito');
        } else {
            return redirect()->route('notas.notaspersonal')->with('mensaje', 'La nota no fue borrada');
        }
    }
}
