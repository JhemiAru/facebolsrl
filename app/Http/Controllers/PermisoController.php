<?php

namespace App\Http\Controllers;

use App\Models\Permiso;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class PermisoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $permisos = Permission::all();
        return view('permisos.index', compact('permisos'));
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
         // Validar los datos del formulario
         $request->validate([
            'name' => 'required|string|max:255|unique:roles,name',
        ]);

        $permiso = new Permission();

        $permiso->name = $request->name;
        $permiso->guard_name = 'web'; // Proporcionar el valor para guard_name
        $permiso->save();

        return redirect()->route('permisos.index')->with('mensaje', 'Se registro el permiso de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $permiso = Permission::findOrFail($id);
        return view('permisos.show', compact('permiso'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $permiso = Permission::findOrFail($id);
        $permiso->name = $request->name;
        $permiso->guard_name = 'web';
        $permiso->save();

        return redirect()->route('permisos.index')->with('mensaje', 'El permiso se actualizó correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $permiso = Permission::findOrFail($id);
        $permiso->delete();

        return redirect()->route('permisos.index')->with('mensaje', 'El permiso se eliminó correctamente');
    }
}
