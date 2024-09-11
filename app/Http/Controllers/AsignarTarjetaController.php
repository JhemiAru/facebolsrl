<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\AsignarTarjeta;
use App\Models\Tarjeta;
use Illuminate\Http\Request;

class AsignarTarjetaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $asignartarjetas = asignartarjeta::all();
        return view('asignartarjetas.index', compact('asignartarjetas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $asignartarjetas = new asignartarjeta();
        $tarjetas = Tarjeta::with('asignartarjeta')
        ->whereDoesntHave('asignartarjeta')
        ->get();

        $inscripcions = Inscripcion::with('informacion')->get(); // Obtiene inscripciones con información relacionada
        return view('asignartarjetas.create', compact('asignartarjetas', 'inscripcions','tarjetas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar los datos
        /* $validatedData = $request->validate([
            'codigo' => 'required|string|max:255',
            'id_inscripcion' => 'required|exists:inscripcions,id',
        ]);

        // Crear una nueva asignartarjeta
        $asignartarjeta = new asignartarjeta();
        $asignartarjeta->codigo = $validatedData['codigo'];
        $asignartarjeta->id_inscripcion = $validatedData['id_inscripcion'];
        $asignartarjeta->save(); */

        // Validar los datos
     /*    $validatedData = $request->validate([
            'codigo' => [
                'required',
                'string',
                'max:255',
                Rule::unique('asignartarjetas')->where(function ($query) use ($request) {
                    return $query->where('codigo', $request->codigo);
                }),
            ],
            'id_inscripcion' => 'required|exists:inscripcions,id',
        ], [
            'codigo.unique' => 'El código de asignartarjeta ya está registrado.',
        ]); */

        // Crear una nueva asignartarjeta
        $asignartarjeta = new asignartarjeta();
       /*  $asignartarjeta->id_tarjeta = $validatedData['codigo'];
        $asignartarjeta->id_inscripcion = $validatedData['id_inscripcion']; */
        $asignartarjeta->id_tarjeta = $request->id_tarjeta;
        $asignartarjeta->id_inscripcion = $request->id_inscripcion;
        $asignartarjeta->save();

        // Redireccionar con un mensaje de éxito
        return redirect()->route('asignartarjetas.index')->with('mensaje', 'Se Registro la asignartarjeta de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        /* $asignartarjeta = asignartarjeta::find($id);
        return view('asignartarjetas.show', compact('asignartarjeta')); */
        $asignartarjeta = asignartarjeta::with('inscripcion.informacion')->findOrFail($id);
        return view('asignartarjetas.show', compact('asignartarjeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(asignartarjeta $asignartarjeta)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, asignartarjeta $asignartarjeta)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(asignartarjeta $asignartarjeta)
    {
        //
    }
}
