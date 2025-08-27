<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\LeccionRequest;
use App\Models\Leccion;
use App\Models\Tema;
use Illuminate\Http\Request;

class LeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
     public function index(Request $req)
    {
        $temaId = $req->get('tema_id');
        $estado = $req->get('estado'); // null|visibles|ocultas
        $temas  = Tema::orderBy('titulo')->get();

        $q = Leccion::query()->with('tema')
            ->when($temaId, fn($q) => $q->where('tema_id', $temaId))
            ->when($estado === 'visibles', fn($q) => $q->where('estado', true))
            ->when($estado === 'ocultas',  fn($q) => $q->where('estado', false));

        $lecciones = $q->paginate(15)->withQueryString();

        return view('admin.lecciones.index', compact('lecciones','temas','temaId','estado'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $temas = Tema::orderBy('titulo')->get();
        return view('admin.lecciones.create', compact('temas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $r)
    {
        $data = $r->validate([
            'tema_id'     => ['required','exists:temas,id'],
            'orden'       => ['nullable','integer','min:1'],
            'titulo'      => ['required','string','max:255'],
            'descripcion' => ['nullable','string'],
            'estado'      => ['sometimes','boolean'],
        ]);

        $data['orden']  = $data['orden'] ?? 1;
        $data['estado'] = $r->boolean('estado');

        Leccion::create($data);
        return redirect()->route('admin.lecciones.index')->with('ok','Lección creada');
    }

    /**
     * Display the specified resource.
     */
    public function show(Leccion $leccion)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Leccion $leccion)
    {
        $temas = Tema::orderBy('titulo')->get();
        return view('admin.lecciones.edit', compact('leccion','temas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $r, Leccion $leccion)
    {
        $data = $r->validate([
            'tema_id'     => ['required','exists:temas,id'],
            'orden'       => ['nullable','integer','min:1'],
            'titulo'      => ['required','string','max:255'],
            'descripcion' => ['nullable','string'],
            'estado'      => ['sometimes','boolean'],
        ]);

        $data['orden']  = $data['orden'] ?? 1;
        $data['estado'] = $r->boolean('estado');

        $leccion->update($data);
        return redirect()->route('admin.lecciones.index')->with('ok','Lección actualizada');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leccion $leccion)
    {
        $leccion->update(['estado'=>false]);
        return back()->with('ok','Lección ocultada');
    }

    // Mostrar nuevamente
    public function restore(Leccion $leccion)
    {
        $leccion->update(['estado'=>true]);
        return back()->with('ok','Lección visible nuevamente');
    }
}
