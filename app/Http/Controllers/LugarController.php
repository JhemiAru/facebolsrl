<?php

namespace App\Http\Controllers;

use App\Models\Lugar;
use Illuminate\Http\Request;

class LugarController extends Controller
{
    /* public function __construct()
    {
        $this->middleware('role:SuperAdmin')->only(['create', 'edit', 'destroy']);
    } */

    public function index()
    {
       /*  $search = $request->query('search');

        $query = Lugar::query();

        if ($search) {
            $query->where(function ($q) use ($search) {
                $q->where('ciudad', 'LIKE', "%{$search}%")
                  ->orWhere('departamento', 'LIKE', "%{$search}%")
                  ->orWhere('provincia', 'LIKE', "%{$search}%");
            });
        }

        $lugares = $query->paginate(5); */
        $lugares = Lugar::all();
        return view('lugar.index', compact('lugares'));
    }

    public function create()
    {
        return view('lugar.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'ciudad' => 'required|string',
            'departamento' => 'required|string',
            'provincia' => 'required|string',
        ]);

        $estado = 1;

        Lugar::create([
            'estado'=> $estado,
            'ciudad' => mb_strtoupper($request->ciudad),
            'departamento' => mb_strtoupper($request->departamento),
            'provincia'=> mb_strtoupper($request->provincia),
        ]);

        return redirect()->route('lugar.index')->with('success', 'Lugar creado exitosamente.');
    }

    public function show(Lugar $lugar)
    {
        return view('lugar.show', compact('lugar'));
    }

    public function edit(Lugar $lugar)
    {
        return view('lugar.edit', compact('lugar'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'estado' => 'required|boolean',
            'ciudad' => 'required|string|max:50',
            'departamento' => 'required|string',
            'provincia' => 'required|string|max:50',
        ]);

        
        $lugar = Lugar::find($id);
        $lugar->estado = $request->estado;
        $lugar->ciudad = mb_strtoupper($request->ciudad);
        $lugar->departamento = mb_strtoupper($request->departamento);
        $lugar->provincia = mb_strtoupper($request->provincia);

        $lugar->save();

        return redirect()->route('lugar.index')->with('success', 'Lugar actualizado exitosamente.');
    }

    public function destroy(Lugar $lugar)
    {
        $lugar->delete();

        return redirect()->route('lugar.index')->with('success', 'Lugar eliminado exitosamente.');
    }
}