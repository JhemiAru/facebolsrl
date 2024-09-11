<?php

namespace App\Http\Controllers;

use App\Models\Requisito;
use Illuminate\Http\Request;

class RequisitoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $requisitos = requisito::all();
        /* $informacions = Informacion::all(); */
        return view('requisitos.index', compact('requisitos'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $requisitos = new requisito();
        /* $siglas = requisito::all(); */
        return view('requisitos.create', compact('requisitos'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
       /*  $request->validate([
            'nombre_requisito'  => 'required',
            'sigla'  => 'required'
        ]); */

        $requisito = new requisito();

        $requisito->requisito = strtoupper($request->requisito);

        // Capturar las primeras tres letras del campo sigla
        /* $requisito->sigla = substr($request->nombre_requisito, 0, 3); */

        /* $requisito->estado = '1'; */
       /*  dd($requisito); */
        $requisito->save();

        return redirect()->route('requisitos.index')->with('mensaje', 'Se registró el requisito de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $requisito = requisito::findOrFail($id);
        return view('requisitos.show', ['requisito' => $requisito]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $requisito = requisito::findOrFail($id);
        return view('requisitos.edit', compact('requisito'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $requisito = requisito::find($id);

        $requisito->requisito = strtoupper($request->requisito);

        // Capturar las primeras tres letras del campo sigla
       /*  $requisito->sigla = substr($request->nombre_requisito, 0, 3);

        $requisito->estado = '1'; */
        /* dd($requisito); */
        $requisito->save();

        return redirect()->route('requisitos.index')->with('mensaje', 'Se Actualizó el requisito de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        requisito::destroy($id);
        requisito::destroy($id);
        return redirect()->route('requisitos.index')->with('mensaje', 'Se elimino el requisito de la manera correcta');
    }
}
