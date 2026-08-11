<?php

namespace App\Http\Controllers;

use App\Models\Sucursal;
use App\Models\Lugar;
use App\Models\Empresa;
use App\Models\Tipo_sedes;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Str;

class SucursalController extends Controller
{
    public function index()
    {
        $lugares = Cache::remember('lugares_todos', 3600, fn() => Lugar::all());
        $empresas = Cache::remember('empresas_todos', 3600, fn() => Empresa::all());
        $tiposede = Cache::remember('tiposede_todos', 3600, fn() => Tipo_sedes::all());

        $sucursales = Cache::remember('sucursales_todos', 3600, fn() =>
            Sucursal::with(['empresa','lugar','tiposede'])->latest()->get()
        );

        return view('sucursal.index', compact('sucursales','lugares','empresas','tiposede'));
    }

    public function create()
    {
        $lugares = Lugar::pluck('departamento', 'id');
        $empresas = Empresa::pluck('nombre_empresa', 'id');
        $tiposede = Tipo_sedes::pluck('nombreSede', 'id');

        return view('sucursal.create', compact('lugares', 'empresas', 'tiposede'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'id_lugar' => 'required|exists:lugar,id',
            'id_empresa' => 'required|exists:empresas,id',
            'id_tiposede' => 'required|exists:tipo_sedes,id',
            'prefijo' => 'required|string'
        ]);

        $prefijo = str_replace('+', '', $request->prefijo);
        $numero = preg_replace('/[^0-9]/', '', $request->telefono);

        $telefono = $prefijo . $numero;

        Sucursal::create([
            'direccion' => strtoupper($request->direccion),
            'telefono' => $telefono,
            'id_lugar' => $request->id_lugar,
            'id_empresa' => $request->id_empresa,
            'id_tiposede' => $request->id_tiposede,
        ]);

        Cache::forget('sucursales_todos');

        return redirect()
            ->route('sucursal.index')
            ->with('success', 'Sucursal creada exitosamente.');
    }

    public function show(Sucursal $sucursal)
    {
        return view('sucursal.show', compact('sucursal'));
    }

    public function edit(Sucursal $sucursal)
    {
        $lugares = Lugar::pluck('departamento', 'id');
        $empresas = Empresa::pluck('nombre_empresa', 'id');
        $tiposede = Tipo_sedes::pluck('nombreSede', 'id');

        return view('sucursal.edit', compact('sucursal','lugares','empresas','tiposede'));
    }

    public function update(Request $request, Sucursal $sucursal)
    {
        $request->validate([
            'direccion' => 'required|string|max:255',
            'telefono' => 'required|string|max:15',
            'id_lugar' => 'required|exists:lugar,id',
            'id_empresa' => 'required|exists:empresas,id',
            'id_tiposede' => 'required|exists:tipo_sedes,id',
            'prefijo' => 'required'
        ]);

        $prefijo = str_replace('+', '', $request->prefijo);

        $numero = preg_replace('/[^0-9]/', '', $request->telefono);

        // eliminar viejo prefijo si existe
        foreach (['591','51','55','56','54','595'] as $p) {
            if (Str::startsWith($numero, $p)) {
                $numero = substr($numero, strlen($p));
                break;
            }
        }

        $telefono = $prefijo . $numero;

        $sucursal->update([
            'direccion' => strtoupper($request->direccion),
            'telefono' => $telefono,
            'id_lugar' => $request->id_lugar,
            'id_empresa' => $request->id_empresa,
            'id_tiposede' => $request->id_tiposede,
        ]);

        Cache::forget('sucursales_todos');

        return redirect()
            ->route('sucursal.index')
            ->with('success', 'Sucursal actualizada correctamente.');
    }

    public function destroy(Sucursal $sucursal)
    {
        $sucursal->delete();
        Cache::forget('sucursales_todos');

        return redirect()
            ->route('sucursal.index')
            ->with('success', 'Sucursal eliminada correctamente.');
    }
}