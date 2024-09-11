<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $usuarios = User::all();
        return view('usuarios.index', ['usuarios' => $usuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $usuarios = User::findOrFail(Auth::user()->id);
        return view('usuarios.create', ['usuario' => $usuarios]);
    }

    /**
     * Store a newly created resource in storage.
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ]);
    }

    public function store(Request $request)
    {
        $usuario = new User();


        $usuario->email = $request->email;
        $usuario->password = Hash::make($request['password']);
        $usuario->estado = '1';


        $usuario->save();

        return redirect()->route('usuarios.index')->with('mensaje', 'Se registro el usuario de la manera correcta');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $usuario = User::findOrFail($id);
        return view('usuarios.show', ['usuario' => $usuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {


        $usuario = User::findOrFail($id); // Ajusta el nombre del modelo según tu caso
        $roles = Role::all(); // Obtén todos los roles disponibles
        return view('usuarios.edit', compact('usuario', 'roles'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $ids)
    {

        $form = $ids % 10;
        $id = floor($ids / 10);
        $usuario = User::findOrFail($id);

        // Validar los campos del formulario
        /* $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email,' . $usuario->id,
            'password' => 'nullable|string|min:8|confirmed',
            'roles' => 'array',
            'roles.*' => 'exists:roles,id',
        ]); */

        if ($form) {
            /* $usuario->email = $request->email; */
            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->password);

                // Cerrar la sesión del usuario actual
                if ($form) {
                    Auth::logout();
                }
            }

            $usuario->save();
            return redirect()->route('login');
            // Actualizar roles del usuario
            /* $usuario->roles()->sync($request->roles); */

            // Redireccionar con un mensaje de éxito

        }else{
            $ci = $usuario->inscripciones->ci;
            $usuario->password = Hash::make($ci);
            $usuario->save();
            return redirect()->route('usuarios.index')->with('mensaje', 'Se actualizo la contraseña del usuario');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        User::destroy($id);
        return redirect()->route('usuarios.index')->with('mensaje', 'Se elimino el usuario de la manera correcta');
    }
}
