<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Sigla;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

use App\Http\Requests\UpdateactividadRequest;
use App\Http\Requests\StoreactividadRequest;

class ActividadController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $actividads = Actividad::all();
        return view('actividads.index', compact('actividads'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $actividads = new actividad();
        return view('actividads.create', compact('actividads'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
       /*  $request->validate([
            'nombre_actividad'  => 'required',
            'sigla'  => 'required'
        ]); */

        $actividad = new actividad();

        $actividad->nombre_actividad = strtoupper($request->nombre_actividad);
        $actividad->save();

        return redirect()->route('actividads.index')->with('mensaje', 'Se registró la activida de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $actividad = actividad::findOrFail($id);
        return view('actividads.show', ['actividad' => $actividad]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $actividad = actividad::findOrFail($id);
        return view('actividads.edit', compact('actividad'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $actividad = actividad::find($id);
        $actividad->nombre_actividad = strtoupper($request->nombre_actividad);
        $actividad->save();

        return redirect()->route('actividads.index')->with('mensaje', 'Se Actualizó la actividad de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        actividad::destroy($id);
        actividad::destroy($id);
        return redirect()->route('actividads.index')->with('mensaje', 'Se elimino la actividad de la manera correcta');
    }
}