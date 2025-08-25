<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Tema;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class TemaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $verBorrados = $request->boolean('ver_borrados');

        $query = Tema::query();
        if (!$verBorrados) {
            $query->where('estado', '!=', 'borrado');
        }

        // (Opcional) orden + paginación
        $temas = $query->orderByDesc('id')->paginate(10)->withQueryString();

        return view('admin.temas.index', compact('temas', 'verBorrados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.temas.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
        ]);

        Tema::create($request->all());

        return redirect()->route('admin.temas.index')
            ->with('success', 'Tema creado correctamente.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Tema $tema)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Tema $tema)
    {
        return view('admin.temas.edit', compact('tema'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Tema $tema)
    {
        $request->validate([
            'titulo' => 'required|string|max:255',
            'descripcion' => 'nullable|string',
            'estado' => 'required|in:activo,desactivado,borrado',
        ]);

        $tema->update($request->all());

        return redirect()->route('admin.temas.index')
            ->with('success', 'Tema actualizado correctamente.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Tema $tema)
    {
        // En vez de eliminar de la base, marcamos como "borrado"
        $tema->update(['estado' => 'borrado']);

        return redirect()->route('admin.temas.index')
            ->with('success', 'Tema marcado como borrado.');
    }
}
