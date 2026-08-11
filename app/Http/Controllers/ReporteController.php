<?php

namespace App\Http\Controllers;

use App\Models\Inscripcion;
use App\Models\Reporte;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

class ReporteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $reportes = Reporte::all();
        $inscripcions = Inscripcion::where('estado', 1)->get(); // Filtrar por inscripciones activas
        return view('reportes.index', compact('reportes', 'inscripcions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //$reportes = Reporte::find($id);
        $inscripcion = Inscripcion::with('reportes')->find($id)->reportes;
        
        return view('inscripciones.show', compact('reportes'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Reporte $reporte)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Reporte $reporte)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Reporte $reporte)
    {
        //
    }
}
