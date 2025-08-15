<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Leccion;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class LeccionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response('Admin: Lecciones index. TODO: vista Blade.', 200);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Leccion $leccion)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Leccion $leccion)
    {
        //
    }
}
