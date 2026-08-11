<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Sigla;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;

use App\Http\Requests\UpdateAreaRequest;
use App\Http\Requests\StoreAreaRequest;

class AreaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $areas = Area::all();
        /* $informacions = Informacion::all(); */
        return view('areas.index', compact('areas'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $areas = new Area();
        /* $siglas = Area::all(); */
        return view('areas.create', compact('areas'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validación de los campos
        /* $request->validate([
            'nombre_area'  => 'required',
            'sigla'  => 'required' 
        ]); */

        $area = new Area();

        $area->nombre_area = strtoupper($request->nombre_area);
        // Capturar las primeras tres letras del campo sigla
        $area->sigla = strtoupper(substr($request->nombre_area, 0, 4));
        $area->estado = '1';
       /*  dd($area); */
        $area->save();

        return redirect()->route('areas.index')->with('mensaje', 'Se registró el área de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.show', ['area' => $area]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $area = Area::findOrFail($id);
        return view('areas.edit', compact('area'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $area = Area::find($id);

        $area->nombre_area = strtoupper($request->nombre_area);

        // Capturar las primeras tres letras del campo sigla
        $area->sigla = strtoupper(substr($request->nombre_area, 0, 4));

        $area->estado = $request->estado;
        /* dd($area); */
        $area->save();

        return redirect()->route('areas.index')->with('mensaje', 'Se Actualizó el área de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Area::destroy($id);
        Area::destroy($id);
        return redirect()->route('areas.index')->with('mensaje', 'Se elimino la area de la manera correcta');
    }
}
