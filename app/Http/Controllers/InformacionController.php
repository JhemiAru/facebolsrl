<?php

namespace App\Http\Controllers;

use App\Models\Informacion;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

use Barryvdh\DomPDF\Facade\Pdf;
//use illuminate\Support\Facades\App;
use Illuminate\Support\Facades\App;


class InformacionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $informacions = Informacion::orderBy('id', 'desc')->get();

        /* $informacions = Informacion::all(); */
        return view('informaciones.index', ['informacions' => $informacions]);
    }

    /* public function reportes()
    {
        return view('informaciones.reportes');
    } */

    public function pdf()
    {
        /* $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream(); */
        $informacions = Informacion::all();
        //$informacions = Informacion::paginate();
        $pdf = Pdf::loadView('informaciones.pdf', compact('informacions'));
        return $pdf->stream();
        //return view('informaciones.pdf', compact('informacions'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('informaciones.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validar la solicitud
        $request->validate([
            'apellido_paterno' => 'required|string|max:255',
            'apellido_materno' => 'required|string|max:255',
            'nombre' => [
                'required',
                'string',
                'max:255',
                Rule::unique('informacions')->where(function ($query) use ($request) {
                    return $query->where('apellido_paterno', $request->apellido_paterno)
                        ->where('apellido_materno', $request->apellido_materno)
                        ->where('nombre', $request->nombre);
                }),
            ],
            'celular' => 'required|regex:/^[0-9]{8,9}$/',
            'insti_univer' => 'required|string|max:255',
            'carrera' => 'required|string|max:255',
            'año' => 'required',
            'invitado_visita' => 'required|string|max:255',
        ], [
            // Mensaje de error personalizado para duplicados
            'nombre.unique' => 'Ya existe una persona registrada con el mismo Apellidos y Nombres.',
        ]);

        // Crear nueva instancia de Informacion
        $informacion = new Informacion();

        $informacion->apellido_paterno = mb_strtoupper($request->apellido_paterno);
        $informacion->apellido_materno = mb_strtoupper($request->apellido_materno);
        $informacion->nombre = mb_strtoupper($request->nombre);
        $informacion->celular = $request->celular;
        $informacion->insti_univer = mb_strtoupper($request->insti_univer);
        $informacion->carrera = mb_strtoupper($request->carrera);
        $informacion->año = mb_strtoupper($request->año);
        $informacion->invitado_visita = mb_strtoupper($request->invitado_visita);
        $formulario = $request->formulario;

        // Guardar la información en la base de datos
        $informacion->save();
        cache()->forget('clientes_facturacion');

        // Redirigir según la condición del formulario
        if ($formulario) {
            return redirect()->route('login')->with('mensaje', 'Se registró la información correctamente.');
        } else {
            return redirect()->route('informaciones.index')->with('mensaje', 'Se registró la información correctamente.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $informacion = Informacion::findOrFail($id);
        return view('informaciones.show', ['informacion' => $informacion]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $informacion = Informacion::findOrFail($id);
        return view('informaciones.edit', ['informacion' => $informacion]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            //'apellido_paterno' => 'required',
            //'apellido_materno' => 'required',
            'nombre' => 'required',
            'celular' => 'required',
            //'correo' => 'required',
            'insti_univer' => 'required',
            'carrera' => 'required',
            'año' => 'required',
            //'turno' => 'required',
            'invitado_visita' => 'required',
        ]);

        $informacion = Informacion::find($id);

        $informacion->apellido_paterno = mb_strtoupper($request->apellido_paterno);
        $informacion->apellido_materno = mb_strtoupper($request->apellido_materno);
        $informacion->nombre = mb_strtoupper($request->nombre);
        $informacion->celular = $request->celular;
        //$informacion->correo = $request->correo;
        $informacion->insti_univer = mb_strtoupper($request->insti_univer);
        $informacion->carrera = mb_strtoupper($request->carrera);
        $informacion->año = mb_strtoupper($request->año);
        //$informacion->turno = strtoupper($request->turno);
        $informacion->invitado_visita = mb_strtoupper($request->invitado_visita);

        $informacion->save();
        cache()->forget('clientes_facturacion');

        return redirect()->route('informaciones.index')->with('mensaje', 'Se actualizo la informacion de la manera correcta');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Informacion::destroy($id);
        return redirect()->route('informaciones.index')->with('mensaje', 'Se elimino la informacion de la manera correcta');
    }
}