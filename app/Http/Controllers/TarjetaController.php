<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Tarjeta;
use App\Models\Informacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Asistencia;

class TarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tarjetas = Tarjeta::with([
        'asignartarjeta.inscripcion.informacion:id,nombre,apellido_paterno,apellido_materno',
        'asignartarjeta' // para que cargue la relación asignartarjeta completa (o puedes filtrar campos)
        ])->orderByDesc('id')->get();

        return view('tarjetas.index', compact('tarjetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $tarjetas = new tarjeta();
        /* $siglas = tarjeta::all(); */
        return view('tarjetas.create', compact('tarjetas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
       /*  $request->validate([
            'nombre_tarjeta'  => 'required',
            'sigla'  => 'required'
        ]); */



        /* $tarjeta = new tarjeta();

        $tarjeta->serie = $request->serie;
        $tarjeta->estado = 1; */
        // Capturar las primeras tres letras del campo sigla
        /* $tarjeta->sigla = substr($request->nombre_tarjeta, 0, 3);

         dd($tarjeta);*/
        /* $tarjeta->save();
        return redirect()->route('tarjetas.index')->with('mensaje', 'Se registró el área de la manera correcta'); */

        $tarjeta = new Tarjeta();
        $tarjeta->serie = $request->serie;
        $tarjeta->estado = $request->estado;
        $tarjeta->save();
        return 'Se Registro nueva tarjeta de manera correcta'. $tarjeta;

    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $tarjeta = tarjeta::findOrFail($id);
        return view('tarjetas.show', ['tarjeta' => $tarjeta]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $tarjeta = tarjeta::findOrFail($id);
        return view('tarjetas.edit', compact('tarjeta'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $tarjeta = tarjeta::find($id);

        /* $tarjeta->serie = $request->serie; */

        // Capturar las primeras tres letras del campo sigla
        /* $tarjeta->sigla = substr($request->nombre_tarjeta, 0, 3); */

        $tarjeta->estado = $request->estado;
        /* dd($tarjeta); */
        $tarjeta->save();

        return redirect()->route('tarjetas.index')->with('mensaje', 'Se Actualizó el área de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Tarjeta::destroy($id);
        Tarjeta::destroy($id);
        return redirect()->route('tarjetas.index')->with('mensaje', 'Se elimino la tarjeta de la manera correcta');
    }
}