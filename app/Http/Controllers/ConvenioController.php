<?php

namespace App\Http\Controllers;

use App\Models\Convenio;
use App\Models\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ConvenioController extends Controller
{
    /* ============================================================
        LISTA DE CONVENIOS (CACHEADA 1 HORA)
    ============================================================ */
    public function index()
    {
        $convenios = Cache::remember('convenios_todos', 3600, fn() =>
            Convenio::with('empresa')->latest()->get()
        );

        $empresas = Cache::remember('empresas_todos', 3600, fn() =>
            Empresa::select('id','nombre_empresa')->get()
        );

        return view('convenios.index', compact('convenios', 'empresas'));
    }

    /* ============================================================
        FORMULARIO CREAR
    ============================================================ */
    public function create()
    {
        $empresas = Empresa::pluck('nombre_empresa', 'id');
        return view('convenios.create', compact('empresas'));
    }

    /* ============================================================
        GUARDAR NUEVO CONVENIO
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'folio'             => 'required|string|max:255',
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'required|date|after_or_equal:fecha_inicio',
            'modalidad'         => 'required|string|max:255',
            'promo_descuentos'  => 'nullable|string|max:255',
            'empresa_id'        => 'required|exists:empresas,id',
            'facebook'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'tik_tok'           => 'nullable|string|max:255',
        ]);

        Convenio::create([
            'estado'            => 1,
            'folio'             => strtoupper($request->folio),
            'fecha_inicio'      => $request->fecha_inicio,
            'fecha_fin'         => $request->fecha_fin,
            'modalidad'         => strtoupper($request->modalidad),
            'promo_descuentos'  => strtoupper($request->promo_descuentos ?? ''),
            'empresa_id'        => $request->empresa_id,
            'facebook'          => $request->facebook ?: null,
            'instagram'         => $request->instagram ?: null,
            'tik_tok'           => $request->tik_tok ?: null,
        ]);

        Cache::forget('convenios_todos');

        return redirect()
            ->route('convenios.index')
            ->with('success', 'Convenio registrado correctamente.');
    }

    /* ============================================================
        MOSTRAR DETALLE
    ============================================================ */
    public function show($id)
    {
        $convenio = Convenio::with('empresa')->findOrFail($id);
        return view('convenios.show', compact('convenio'));
    }

    /* ============================================================
        FORMULARIO EDITAR
    ============================================================ */
    public function edit($id)
    {
        $convenio = Convenio::findOrFail($id);
        $empresas = Empresa::pluck('nombre_empresa', 'id');

        return view('convenios.edit', compact('convenio', 'empresas'));
    }

    /* ============================================================
        ACTUALIZAR CONVENIO
    ============================================================ */
    public function update(Request $request, $id)
    {
        $convenio = Convenio::findOrFail($id);

        $request->validate([
            'folio'             => 'required|string|max:255',
            'fecha_inicio'      => 'required|date',
            'fecha_fin'         => 'required|date|after_or_equal:fecha_inicio',
            'modalidad'         => 'required|string|max:255',
            'promo_descuentos'  => 'nullable|string|max:255',
            'empresa_id'        => 'required|exists:empresas,id',
            'facebook'          => 'nullable|string|max:255',
            'instagram'         => 'nullable|string|max:255',
            'tik_tok'           => 'nullable|string|max:255',
            'estado'            => 'required|boolean',
        ]);

        $convenio->update([
            'estado'            => $request->estado,
            'folio'             => strtoupper($request->folio),
            'fecha_inicio'      => $request->fecha_inicio,
            'fecha_fin'         => $request->fecha_fin,
            'modalidad'         => strtoupper($request->modalidad),
            'promo_descuentos'  => strtoupper($request->promo_descuentos ?? ''),
            'empresa_id'        => $request->empresa_id,
            'facebook'          => $request->facebook ?: null,
            'instagram'         => $request->instagram ?: null,
            'tik_tok'           => $request->tik_tok ?: null,
        ]);

        Cache::forget('convenios_todos');

        return redirect()
            ->route('convenios.index')
            ->with('success', 'Convenio actualizado correctamente.');
    }

    /* ============================================================
        ELIMINAR CONVENIO
    ============================================================ */
    public function destroy($id)
    {
        $convenio = Convenio::findOrFail($id);
        $convenio->delete();

        Cache::forget('convenios_todos');

        return redirect()
            ->route('convenios.index')
            ->with('success', 'Convenio eliminado correctamente.');
    }
}