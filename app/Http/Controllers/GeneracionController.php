<?php

namespace App\Http\Controllers;

use App\Models\Generacion;
use Generator;
use Illuminate\Http\Request;

class GeneracionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $generacions = Generacion::all( );
        /* $informacions = Informacion::all(); */
        return view('generaciones.index', compact('generacions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $generacions = new Generacion();
        return view('generaciones.create', compact('generacions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $generacion = new Generacion();

        $generacion->generacion = $request->generacion;
        $generacion->estado = '1';
        $generacion->año = $request->año;

        $generacion->save();

        return redirect()->route('generaciones.index')->with('mensaje', 'Se registro la generacion de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $generacion = Generacion::findOrFail($id);
        return view('generaciones.show', ['generacion' => $generacion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $generacion = Generacion::findOrFail($id);
        return view('generaciones.edit', ['generacion' => $generacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $generacion = Generacion::find($id);

        $generacion->generacion = $request->generacion;
        $generacion->estado = $request->estado;
        $generacion->año = $request->año;
        /* dd($area); */
        $generacion->save();

        return redirect()->route('generaciones.index')->with('mensaje', 'Se Actualizó la generacion de manera correcta');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Generacion::destroy($id);
        return redirect()->route('generaciones.index')->with('mensaje', 'Se elimino la generacion de la manera correcta');
    }
}
