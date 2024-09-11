<?php

namespace App\Http\Controllers;

use App\Models\detalle;
use App\Models\Area;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

use App\Http\Requests\UpdatedetalleRequest;
use App\Http\Requests\StoredetalleRequest;
use App\Models\programa;

class detalleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $detalles = Detalle::all();

        /* $informacions = Informacion::all(); */
        return view('detalles.index', compact('detalles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $detalles = new detalle();
        $areas = Area::all();
        $programas = Programa::all();
        return view('detalles.create', compact('detalles','areas','programas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
       /*  $request->validate([
            'nombre_detalle'  => 'required',
            'sigla'  => 'required'
        ]); */

        $detalle = new detalle();

        /* $detalle->detalle = $request->detalle; */

        // Capturar las primeras tres letras del campo sigla
        $detalle->descripcion = $request->descripcion;
        $detalle->id_area = $request->id_area;
        $detalle->id_programa = $request->id_programa;

        /* $detalle->estado = '1'; */
       /*  dd($detalle); */
        $detalle->save();

        return redirect()->route('detalles.index')->with('mensaje', 'Se registró el área de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $detalle = detalle::findOrFail($id);
        return view('detalles.show', ['detalle' => $detalle]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $detalle = detalle::findOrFail($id);
        return view('detalles.edit', compact('detalle'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $detalle = detalle::find($id);

        $detalle->detalle =$request->detalle;

        // Capturar las primeras tres letras del campo sigla
        $detalle->tipo_hora = $request->tipo_hora;

        /* $detalle->estado = '1'; */
        /* dd($detalle); */
        $detalle->save();

        return redirect()->route('detalles.index')->with('mensaje', 'Se Actualizó el área de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        detalle::destroy($id);
        detalle::destroy($id);
        return redirect()->route('detalles.index')->with('mensaje', 'Se elimino la detalle de la manera correcta');
    }
}
