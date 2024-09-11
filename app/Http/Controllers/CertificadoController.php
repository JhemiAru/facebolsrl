<?php

namespace App\Http\Controllers;
use Carbon\Carbon;
use App\Models\certificado;
use App\Models\detalle;
use App\Models\Asistencia;
use Illuminate\Console\Signals;
use Illuminate\Http\Request;
use PhpParser\Node\Arg;
use Illuminate\Support\Facades\DB;
use App\Http\Requests\UpdatecertificadoRequest;
use App\Http\Requests\StorecertificadoRequest;
use App\Models\Inscripcion;
use App\Models\programa;

class certificadoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $certificados = certificado::all();

        /* $informacions = Informacion::all(); */
        return view('certificados.index', compact('certificados'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $certificados = new certificado();
        $detalles = detalle::all();
        $inscripcions = Inscripcion::all();
        return view('certificados.create', compact('certificados','detalles','inscripcions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        // Validación de los campos
        /* $request->validate([
            'nombre_certificado'  => 'required',
            'sigla'  => 'required'
        ]); */
        $horaacumulada = Asistencia::select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(horas))) AS total_horas'))
                ->where('id_inscripcion', $request->id_inscripcion)
                ->first();
        $fechaInicio = Asistencia::where('id_inscripcion', $request->id_inscripcion)
                ->orderBy('fecha', 'asc')
                ->value('fecha');
        $fechaInicioCarbon = Carbon::parse($fechaInicio);
        $fechainicio1 = $fechaInicioCarbon->format('Y-m-d');
        $fechaFin = Asistencia::where('id_inscripcion', $request->id_inscripcion)
                ->orderBy('fecha', 'desc')
                ->value('fecha');
        $fechaFinCarbon = Carbon::parse($fechaFin);
        $fechafin1 = $fechaFinCarbon->format('Y-m-d');
        // Calcula la diferencia en meses entre las dos fechas
        $diferencia = $fechaInicio->diff($fechaFin);
        // Obtiene el número total de meses entre las fechas
        $mesesTotales = $diferencia->y * 12 + $diferencia->m;
        // También puedes obtener los meses restantes si los días restantes son más de 0
        if ($diferencia->d > 0) {
            $mesesTotales += 1;
        }
        $fechaActual = Carbon::now();
        $fechaActual1 = $fechaActual->format('Y-m-d');
        $certificado = new certificado();
        // Capturar las primeras tres letras del campo sigla
        $certificado->id_detalle = $request->id_detalle;
        $certificado->id_inscripcion = $request->id_inscripcion;
        $certificado->horas = $horaacumulada->total_horas;
        $certificado->fecha_inicio = $fechainicio1;
        $certificado->fecha_fin = $fechafin1;
        $certificado->meses = $mesesTotales;
        $certificado->fecha_entrega = $fechaActual1;
        /*  dd($certificado); */
        $certificado->save();

        return redirect()->route('certificados.index')->with('mensaje', 'Se registró el área de la manera correcta');
    }


    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $certificado = certificado::findOrFail($id);
        return view('certificados.show', ['certificado' => $certificado]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $certificado = certificado::findOrFail($id);
        $detalles = detalle::all();
        $inscripcions = Inscripcion::all();
        return view('certificados.edit', compact('certificado','detalles','inscripcions'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $certificado = certificado::find($id);

        $horaacumulada = Asistencia::select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(horas))) AS total_horas'))
                ->where('id_inscripcion', $request->id_inscripcion)
                ->first();
        $fechaInicio = Asistencia::where('id_inscripcion', $request->id_inscripcion)
                ->orderBy('fecha', 'asc')
                ->value('fecha');
        $fechaInicioCarbon = Carbon::parse($fechaInicio);
        $fechainicio1 = $fechaInicioCarbon->format('Y-m-d');
        $fechaFin = Asistencia::where('id_inscripcion', $request->id_inscripcion)
                ->orderBy('fecha', 'desc')
                ->value('fecha');
        $fechaFinCarbon = Carbon::parse($fechaFin);
        $fechafin1 = $fechaFinCarbon->format('Y-m-d');
        // Calcula la diferencia en meses entre las dos fechas
        $diferencia = $fechaInicio->diff($fechaFin);
        // Obtiene el número total de meses entre las fechas
        $mesesTotales = $diferencia->y * 12 + $diferencia->m;
        // También puedes obtener los meses restantes si los días restantes son más de 0
        if ($diferencia->d > 0) {
            $mesesTotales += 1;
        }
        $fechaActual = Carbon::now();
        $fechaActual1 = $fechaActual->format('Y-m-d');
        /* $certificado = new certificado(); */
        // Capturar las primeras tres letras del campo sigla
        $certificado->id_detalle = $request->id_detalle;
        $certificado->id_inscripcion = $request->id_inscripcion;
        $certificado->horas = $horaacumulada->total_horas;
        $certificado->fecha_inicio = $fechainicio1;
        $certificado->fecha_fin = $fechafin1;
        $certificado->meses = $mesesTotales;
        $certificado->fecha_entrega = $fechaActual1;
        /*  dd($certificado); */
        $certificado->save();

        return redirect()->route('certificados.index')->with('mensaje', 'Se Actualizó el área de manera correcta');
    }


    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        certificado::destroy($id);
        certificado::destroy($id);
        return redirect()->route('certificados.index')->with('mensaje', 'Se elimino la certificado de la manera correcta');
    }
}
