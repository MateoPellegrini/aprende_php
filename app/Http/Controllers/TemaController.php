<?php

namespace App\Http\Controllers;

use Illuminate\Http\Response;

class TemaController extends Controller
{
    public function index(): Response
    {
        return response('Listado de temas (usuario). TODO: vista Blade.', 200);
    }
}
