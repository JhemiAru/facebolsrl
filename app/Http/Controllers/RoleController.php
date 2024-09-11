<?php

namespace App\Http\Controllers;

use App\Models\Role;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Permission;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $roles = Role::with('permissions')->get();
        $permissions = Permission::all()->pluck('name', 'id'); // Obtener todos los permisos
        return view('roles.index', compact('roles', 'permissions'));
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

        $role = new Role();

        $role->name = $request->name;
        $role->guard_name = 'web'; // Proporcionar el valor para guard_name
        $role->save();

        $role->permissions()->sync($request->input('permissions', [])); // Sincronizar los permisos seleccionados

        return redirect()->route('roles.index')->with('mensaje', 'Se registro el Rol de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $role = Role::findOrFail($id);
        return view('roles.show', compact('role'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        /* $role = Role::all();
        $permisos = Permission::all();
        return view('roles.index', compact('role', 'permisos')); */
        $roles = Role::findOrFail($id);
        $permissions = Permission::all()->pluck('name', 'id');
        $rolePermissions = $roles->permissions()->pluck('id')->toArray();
        return view('roles.edit', compact('roles', 'permissions', 'rolePermissions'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:roles,name,' . $id,
        ]);

        $role = Role::findOrFail($id);
        $role->name = $request->name;
        $role->guard_name = 'web';
        $role->save();

        $role->permissions()->sync($request->input('permissions', [])); // Sincronizar los permisos seleccionados

        return redirect()->route('roles.index')->with('mensaje', 'El rol se actualizó correctamente');
    }



    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $role = Role::findOrFail($id);
        $role->delete();

        return redirect()->route('roles.index')->with('mensaje', 'El rol se eliminó correctamente');
    }
}
