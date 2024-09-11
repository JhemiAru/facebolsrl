<?php

namespace App\Http\Controllers;

use App\Models\Persona;
use App\Models\Area;
use App\Models\Requisito;
use App\Models\AsignarRequisito;
//use App\Models\AsignarEstado;
use App\Models\Extension;
use App\Models\Role;
use App\Models\Generacion;
use App\Models\Informacion;
use App\Models\Inscripcion;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class InscripcionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {

        $excludedIds = [];
        $i = Auth::user()->roles->id;
        while ($i > 0) {
            $excludedIds[] = $i;
            $i--;
        }

        $inscripcions = Inscripcion::with('informacion')
            ->whereDoesntHave('informacion.inscripciones.users.roles', function ($query) use ($excludedIds) {
                $query->whereIn('id', $excludedIds);
            })
            ->get()
            ->sortByDesc('id');
        /* dd($excludedIds); */
       /*  $inscripcions = Inscripcion::with('informacion')->get()->sortByDesc('id'); */
        /* $informacions = Informacion::all(); */
        //return view('inscripciones.index', ['inscripcions' => $inscripcions]);
        return view('inscripciones.index', compact('inscripcions', 'inscripcions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $inscripcions = new Inscripcion();
        /*  $informacions = Informacion::all(); */

        $informacions = Informacion::with('inscripciones')
            ->whereDoesntHave('inscripciones')
            ->get();

        $generacions = Generacion::all();
        $areas = Area::all();
        $requisitos = Requisito::all();
        $extensions = Extension::all();
        $roles = Role::all();

        $c_inscritos = Inscripcion::select('areas.id as area_id', 'generacions.id as generacion_id', DB::raw('COUNT(inscripcions.id) as c_inscritos'))
            ->join('areas', 'inscripcions.id_area', '=', 'areas.id')
            ->join('generacions', 'inscripcions.id_generacion', '=', 'generacions.id')
            ->groupBy('areas.id', 'generacions.id')
            ->get();

        /* dd($c_inscritos); */
        /* return view('Inscripciones.create', ['inscripcions'=>$inscripcions, 'informacions'=>$informacions, 'generacions'=>$generacions, 'areas'=>$areas]); */

        return view('inscripciones.create', compact('inscripcions', 'informacions', 'generacions', 'areas', 'requisitos', 'c_inscritos','extensions','roles'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        request()->validate(inscripcion::$rules);

        // Validación de los requisitos
        $request->validate([
            'requisito' => 'required|array',
            'requisito.*' => 'required|in:0,1', // Cada requisito debe ser 0 o 1
        ], [
            'requisito.required' => 'Debe seleccionar una opción para cada requisito.',
            'requisito.*.required' => 'Debe seleccionar una opción para cada requisito.',
            'requisito.*.in' => 'La opción seleccionada es inválida.',
        ]);

        $inscripcion = new Inscripcion();

        $inscripcion->estado = 1;
        $inscripcion->f_inscripcion = $request->f_inscripcion;
        $inscripcion->recibos = mb_strtoupper($request->recibos);
        $inscripcion->direccion = mb_strtoupper($request->direccion);
        $inscripcion->ci = mb_strtoupper($request->ci);
        $inscripcion->genero = mb_strtoupper($request->genero);
        $inscripcion->codigo_credencial = mb_strtoupper($request->codigo_credencial);
        $inscripcion->id_informacion = $request->id_informacion;
        $inscripcion->id_generacion = $request->id_generacion;
        $inscripcion->id_area = $request->id_area;
        $inscripcion->id_extension = $request->id_extension;

        //$inscripcion->contraseña = Hash::make($request->ci);
        $inscripcion->save();

        $usuario = new User();
        $usuario->email = $request->email;
        $usuario->password = Hash::make($request->ci);;
        $usuario->codigo_credencial = strtoupper($request->codigo_credencial);
        $usuario->estado = 1;
        $usuario->id_role = $request->id_role;
        $usuario->save();


        // Obtener los estados de los requisitos del request
        $id_inscripcion = Inscripcion::latest('id')->first();
        $estados = $request->input('requisito');

        // Contar el número total de requisitos y los entregados
        $totalRequisitos = count($estados);
        $requisitosEntregados = 0;

        // Iterar sobre los estados y crear cada requisito
        foreach ($estados as $id => $estado) {
            $requisito = new AsignarRequisito();
            $requisito->id_inscripcion = $id_inscripcion->id;
            $requisito->id_requisito = $id; // Asume que 'requisito' es el ID o nombre del requisito
            $requisito->estado = $estado == 1 ? 1 : 0; // Establecer el estado del requisito
            $requisito->save();

            if ($estado == 1) {
                $requisitosEntregados++;
            }
        }

        // Calcular el porcentaje de requisitos entregados
        $porcentaje = ($requisitosEntregados / $totalRequisitos) * 100;

        // Guardar el porcentaje en la inscripción
        $inscripcion->porcentaje_requisitos = $porcentaje;
        $inscripcion->save();

        return redirect()->route('inscripciones.index')->with('mensaje', 'Se registro la inscripcion de la manera correcta');
        /* dd($request->all()); */
        /*    $me=$request->all() */
        /* $request['estado'] = 1;
            $inscripcion = Inscripcion::create($request->all()); */
        /* dd($me); */
        /* return redirect()->route('inscripciones.index')->with('success', 'datos creados satisfactoriamente');
 */
    }
    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $inscripcion = Inscripcion::find($id);
        $requisitos = Requisito::all();
        $asignarRequisitos = AsignarRequisito::where('id_inscripcion', $id)->get()->keyBy('id_requisito');
        return view('inscripciones.show', compact('inscripcion','requisitos','asignarRequisitos'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $inscripcion = Inscripcion::find($id);
        $informacions = Informacion::all();
        $generacions = Generacion::all();
        $areas = Area::all();
        $requisitos = Requisito::all();
        $asignarRequisitos = AsignarRequisito::where('id_inscripcion', $id)->get()->keyBy('id_requisito');
        $extensions = Extension::all();
        $roles = Role::all();
        // Obtener el estado asignado actualmente
        //$asignarEstado = AsignarEstado::where('id_inscripcion', $id)->first();

        $c_inscritos = Inscripcion::select('areas.id as area_id', 'generacions.id as generacion_id', DB::raw('COUNT(inscripcions.id) as c_inscritos'))
            ->join('areas', 'inscripcions.id_area', '=', 'areas.id')
            ->join('generacions', 'inscripcions.id_generacion', '=', 'generacions.id')
            ->groupBy('areas.id', 'generacions.id')
            ->get();
        /* dd($informacions); */
        /* return view('Inscripciones.create', ['inscripcions'=>$inscripcions, 'informacions'=>$informacions, 'generacions'=>$generacions, 'areas'=>$areas]); */
        /*  dd($inscripcion); */
        return view('inscripciones.edit', compact('inscripcion', 'informacions', 'generacions', 'areas', 'requisitos', 'asignarRequisitos','c_inscritos', 'extensions','roles'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {

        /* $request->validate([
            'f_inscripcion' => 'required',
            'recibos' => 'required',
            'direccion' => 'required',
            'codigo_credencial' => 'required',
            'id_informacion' => 'required',
            'id_generacion' => 'required',
            'id_area' => 'required',
        ]); */

        request()->validate(inscripcion::$rules);

        $inscripcion = Inscripcion::findOrFail($id);

        $inscripcion->estado = $request->estado;
        $inscripcion->f_inscripcion = $request->f_inscripcion;
        $inscripcion->recibos = mb_strtoupper($request->recibos);
        //$inscripcion->email = $request->email;
        $inscripcion->direccion = mb_strtoupper($request->direccion);
        $inscripcion->codigo_credencial = mb_strtoupper($request->codigo_credencial);
        $inscripcion->id_informacion = $request->id_informacion;
        $inscripcion->id_generacion = $request->id_generacion;
        $inscripcion->id_area = $request->id_area;
        $inscripcion->ci = mb_strtoupper($request->ci);
        $inscripcion->genero = mb_strtoupper($request->genero);
        $inscripcion->id_extension = $request->id_extension;
        //$inscripcion->id_role = $request->id_role;
        //$inscripcion->contraseña = Hash::make($request->contraseña);
        $inscripcion->save();

        $usuario = $inscripcion->users;
        /* dd($usuario); */
        // Actualizar los datos del usuario
        if ($usuario) {
            $usuario->email = $request->email;
            $usuario->password = Hash::make($request->ci);
            $usuario->codigo_credencial = strtoupper($request->codigo_credencial);
            $usuario->estado = 1;
            $usuario->id_role = $request->id_role;
        
            
            $usuario->save();
        
        }

        // Elimina los requisitos actuales de la inscripción
        AsignarRequisito::where('id_inscripcion', $id)->delete();

        // Itera sobre los estados de los requisitos y crea registros para cada uno
        if ($request->has('requisito')) {
            $estados = $request->input('requisito');
            foreach ($estados as $requisitoId => $estado) {
                $asignarRequisito = new AsignarRequisito();
                $asignarRequisito->id_inscripcion = $inscripcion->id;
                $asignarRequisito->id_requisito = $requisitoId;
                $asignarRequisito->estado = $estado == 1 ? 1 : 0;
                $asignarRequisito->save();
            }
        }

        $requisitos = Requisito::all(); // Aseguramos de obtener los requisitos actualizados
        // Recalcular porcentaje de requisitos completados
        $totalRequisitos = count($requisitos);
        $requisitosCumplidos = AsignarRequisito::where('id_inscripcion', $id)->where('estado', 1)->count();
        $porcentajeRequisitos = $totalRequisitos > 0 ? ($requisitosCumplidos / $totalRequisitos) * 100 : 0;

        // Actualizar el campo en la inscripción
        $inscripcion->porcentaje_requisitos = $porcentajeRequisitos;
        $inscripcion->save();

        return redirect()->route('inscripciones.index')->with('mensaje', 'Inscripción actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Inscripcion::destroy($id);
        return redirect()->route('inscripciones.index')->with('mensaje', 'Se elimino la inscripcion de la manera correcta');
    }
}
