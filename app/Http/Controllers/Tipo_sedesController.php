<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Tipo_sedes;
use Illuminate\Http\Request;

class Tipo_sedesController extends Controller
{
    
    public function index()
    {
        $tipo_sed = Tipo_sedes::all();
        return view('tipo_sedes.index', compact('tipo_sed'));
    }

    public function create()
    {
        return view('tipo_sedes.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nombreSede' => 'required|string|max:255',
        ]);

        $estado = 1;

        Tipo_sedes::create([
            'nombreSede' => $request->nombreSede,
            'estado' => $estado,
        ]);

        return redirect()->route('tipo_sedes.index')->with('success', 'Tipo de sede registrada correctamente.');
    }

    public function show($id)
    {
        $tipo_sede = Tipo_sedes::findOrFail($id);
        return view('tipo_sedes.show', compact('tipo_sede'));
    }

    public function edit($id)
    {
        $tipo_sede = Tipo_sedes::findOrFail($id);
        return view('tipo_sedes.edit', compact('tipo_sede'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'nombreSede' => 'required|string|max:255',
            'estado' => 'required|boolean', // Validación para asegurar que estado sea 0 o 1
        ]);

        $tipoSede = Tipo_sedes::findOrFail($id);

        $tipoSede->update([
            'nombreSede' => $request->nombreSede,
            'estado' => $request->input('estado', 0), // Usa el valor del select directamente
        ]);

        return redirect()->route('tipo_sedes.index')->with('success', 'Tipo de sede actualizada correctamente.');
    }

    public function destroy($id)
    {
        $tipo_sede = Tipo_sedes::findOrFail($id);
        $tipo_sede->delete();

        return redirect()->route('tipo_sedes.index')->with('success', 'Tipo de sede eliminada correctamente.');
    }
}
