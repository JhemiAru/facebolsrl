<?php

namespace App\Http\Controllers;

use App\Models\multa;
use App\Models\Sigla;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

use App\Http\Requests\UpdatemultaRequest;
use App\Http\Requests\StoremultaRequest;

class multaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $multas = multa::all();
        /* $informacions = Informacion::all(); */
        return view('multas.index', compact('multas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $multas = new multa();
        /* $siglas = multa::all(); */
        return view('multas.create', compact('multas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        /*  $request->validate([
            'monto_multa'  => 'required',
            'sigla'  => 'required'
        ]); */
        $multa = new multa();
        $multa->nombre_multa = strtoupper($request->nombre_multa);
        $multa->monto = $request->monto;
        $multa->p1 = $request->p1;
        $multa->p2 = $request->p2;
        $multa->turno = strtoupper($request->turno);
        $multa->save();

        return redirect()->route('multas.index')->with('mensaje', 'Se registró la multa de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $multa = multa::findOrFail($id);
        // Convertir el valor del turno a texto
        $multa->turno = $multa->turno == 1 ? 'Mañana' : ($multa->turno == 0 ? 'Tarde' : '');
        return view('multas.show', compact('multa'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $multa = multa::findOrFail($id);
        return view('multas.edit', compact('multa'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $multa = multa::find($id);
        $multa->nombre_multa = strtoupper($request->nombre_multa);
        $multa->monto = $request->monto;
        $multa->p1 = $request->p1;
        $multa->p2 = $request->p2;
        $multa->turno = strtoupper($request->turno);
        $multa->save();
        return redirect()->route('multas.index')->with('mensaje', 'Se Actualizó la multa de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        multa::destroy($id);
        multa::destroy($id);
        return redirect()->route('multas.index')->with('mensaje', 'Se elimino la multa de la manera correcta');
    }
}
