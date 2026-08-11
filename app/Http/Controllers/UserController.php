<?php
 
namespace App\Http\Controllers;
 
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;
/* use Illuminate\Support\Facades\Storage; */

 
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /*         $usuarios = User::all(); */
            $usuarios = User::with([
            'roles:id,name',                      // Carga los roles
            'inscripciones.informacion:id,nombre,apellido_paterno,apellido_materno,id' // Carga la info de inscripción
        ])->orderByDesc('id')->get();

        return view('usuarios.index', ['usuarios' => $usuarios]);
    }
 
    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if (!Auth::check()) {
        return redirect()->route('login'); // o manejar como prefieras
         }
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
    /* public function update(Request $request, $ids)
    {
        // Dividir el id y el formulario que identificaste
        $form = $ids % 10;
        $id = floor($ids / 10);
        $usuario = User::findOrFail($id);
 
        if ($form) {
            if ($request->filled('password')) {
                $usuario->password = Hash::make($request->password);
 
                if ($form) {
                    Auth::logout();
                }
            }
 
            // Validar la subida de la foto
            if ($request->hasFile('foto')) {
                // Obtener el CI del usuario a través de su inscripción
                $ci = $usuario->inscripciones->ci;
 
                $imageName = $ci . '.' . $request->file('foto')->getClientOriginalExtension();
 
                $path = $request->file('foto')->storeAs('fotos', $imageName, 'public');
                $usuario->foto = $path; // Guardar la ruta de la foto en la base de datos
            }
 
            $usuario->save();
            return redirect()->route('login');  // Redirigir al login si el usuario es desconectado
        } else {
            $ci = $usuario->inscripciones->ci;
            $usuario->password = Hash::make($ci);
 
            $usuario->save();
 
            return redirect()->route('usuarios.index')->with('mensaje', 'Se actualizó la contraseña del usuario');
        }
    } */
    
public function update(Request $request, $ids)
{
    $form = $ids % 10;
    $id = floor($ids / 10);
    $usuario = User::findOrFail($id);

    if ($form && Auth::id() !== $usuario->id) {
        abort(403, 'No tienes permiso para realizar esta acción.');
    }

    if ($form) {

        // ✅ SOLO valida contraseña si viene llena
        if ($request->filled('password')) {

            $request->validate([
                'password' => ['min:8', 'confirmed'],
            ], [
                'password.min' => 'La contraseña debe tener al menos 8 caracteres.',
                'password.confirmed' => 'Las contraseñas no coinciden.',
            ]);

            $usuario->password = Hash::make($request->password);
            Auth::logout();
        }

        // ✅ Foto independiente
        if ($request->hasFile('foto')) {

            if (
                $usuario->foto &&
                $usuario->foto !== 'fotos/foto_principal.jpg' &&
                file_exists(public_path($usuario->foto))
            ) {
                unlink(public_path($usuario->foto));
            }

            $ci = $usuario->inscripciones->ci;

            $destinationPath = public_path('fotos');

            $imageName = uniqid($ci . '_') . '.' . 
                $request->file('foto')->getClientOriginalExtension();

            $request->file('foto')->move($destinationPath, $imageName);

            $usuario->foto = 'fotos/' . $imageName;
        }

        $usuario->save();

        // 🔥 Solo redirige al login si cambió contraseña
        if ($request->filled('password')) {
            return redirect()->route('login');
        }

        return redirect()->back()->with('mensaje', 'Foto actualizada correctamente');
    } 
    else {

        $ci = $usuario->inscripciones->ci;
        $usuario->password = Hash::make($ci);
        $usuario->save();

        return redirect()->route('usuarios.index')
            ->with('mensaje', 'Se actualizó la contraseña del usuario');
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