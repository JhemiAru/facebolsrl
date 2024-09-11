<?php

namespace App\Http\Controllers;

use App\Models\Extension;
use Illuminate\Http\Request;

class ExtensionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $extensions = Extension::all();
        /* $informacions = Informacion::all(); */
        return view('extensiones.index', compact('extensions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $extensions = new Extension();
        /* $siglas = Area::all(); */
        return view('extensiones.create', compact('extensions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $extension = new Extension();

        $extension->ciudad = strtoupper($request->ciudad);

        // Capturar las primeras tres letras del campo sigla
        $extension->expedido = strtoupper($request->expedido);
        /* dd($extension); */
        $extension->save();

        return redirect()->route('extensiones.index')->with('mensaje', 'Se registró la extensión de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $extension = Extension::findOrFail($id);
        return view('extensiones.show', ['extension' => $extension]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $extension = Extension::findOrFail($id);
        return view('extensiones.edit', compact('extension'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $extension = Extension::find($id);

        $extension->ciudad = strtoupper($request->ciudad);

        // Capturar las primeras tres letras del campo sigla
        $extension->expedido = strtoupper($request->expedido);
        /* dd($area); */
        $extension->save();

        return redirect()->route('extensiones.index')->with('mensaje', 'Se Actualizó la extension de manera correcta');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Extension::destroy($id);
        return redirect()->route('extensiones.index')->with('mensaje', 'Se elimino el expedido de la manera correcta');
    }
}
