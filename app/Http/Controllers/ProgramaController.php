<?php

namespace App\Http\Controllers;

use App\Models\programa;
use App\Models\Sigla;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

use App\Http\Requests\UpdateprogramaRequest;
use App\Http\Requests\StoreprogramaRequest;

class ProgramaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programas = programa::all();
        /* $informacions = Informacion::all(); */
        return view('programas.index', compact('programas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $programas = new programa();
        /* $siglas = programa::all(); */
        return view('programas.create', compact('programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
       /*  $request->validate([
            'nombre_programa'  => 'required',
            'sigla'  => 'required'
        ]); */

        $programa = new programa();

        $programa->programa = $request->programa;

        // Capturar las primeras tres letras del campo sigla
        $programa->tipo_hora = $request->tipo_hora;

        /* $programa->estado = '1'; */
       /*  dd($programa); */
        $programa->save();

        return redirect()->route('programas.index')->with('mensaje', 'Se registró el área de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $programa = programa::findOrFail($id);
        return view('programas.show', ['programa' => $programa]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $programa = programa::findOrFail($id);
        return view('programas.edit', compact('programa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $programa = programa::find($id);

        $programa->programa =$request->programa;

        // Capturar las primeras tres letras del campo sigla
        $programa->tipo_hora = $request->tipo_hora;

        /* $programa->estado = '1'; */
        /* dd($programa); */
        $programa->save();

        return redirect()->route('programas.index')->with('mensaje', 'Se Actualizó el área de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        programa::destroy($id);
        programa::destroy($id);
        return redirect()->route('programas.index')->with('mensaje', 'Se elimino la programa de la manera correcta');
    }
}
