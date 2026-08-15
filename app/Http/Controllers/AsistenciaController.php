<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\Models\AsignarTarjeta;
use App\Models\Asistencia;
use App\Models\Generacion;
use App\Models\Inscripcion;
use App\Models\Tarjeta;
use App\Models\Area;
use App\Models\Multa;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\TotalHora; // 👈 AÑADE ESTA LÍNEA

/* use Illuminate\Support\Facades\Log; */

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $asistencias = Asistencia::with('inscripcion')->get(); */
        /* $asistencias = Asistencia::all();
        $inscripcions = Inscripcion::all();
        $multas = Inscripcion::all();
        return view('asistencias.index', compact('asistencias', 'inscripcions', 'multas')); */
        
        $inscripcions = Inscripcion::with([
            'informacion:id,nombre,apellido_paterno,apellido_materno,id',
            'asistencias.multa:id,turno',  // <-- quitar id_multa aquí
            'generacion:id,generacion',
            'area:id,nombre_area'
        ])
        ->orderByDesc('id')
        ->get();

        return view('asistencias.index', compact('inscripcions'));
    }

    public function pdf($id = null)
    {
        /* $pdf = App::make('dompdf.wrapper');
        $pdf->loadHTML('<h1>Test</h1>');
        return $pdf->stream(); */
        //$asistencias = Asistencia::all();
        //$asistencias = Asistencia::paginate();
        
        /* $id_inscripcion = Auth::user()->id_inscripcion;

        // Obtener asistencias (si no hay resultados, devuelve una colección vacía en lugar de null)
        $asistencias = Asistencia::where('id_inscripcion', $id_inscripcion)->get();

        if ($asistencias->isEmpty()) {
            $asistencias = collect(); // Asegura que no sea null
        }

        $pdf = Pdf::loadView('asistencias.pdf', compact('asistencias'));
        return $pdf->stream(); */
        //return view('asistencias.pdf');

        if ($id) {
            $inscripcion = Inscripcion::find($id);
        } else {
            $codigo = Auth::user()->codigo_credencial;
            $inscripcion = Inscripcion::where('codigo_credencial', $codigo)->first();
        }
        
        if ($inscripcion) {
            $asistencias = Asistencia::where('id_inscripcion', $inscripcion->id)->get();
            
            // Calcular total de horas base
            $horaacumulada = Asistencia::select(\Illuminate\Support\Facades\DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(horas))) AS total_horas'))
                ->where('id_inscripcion', $inscripcion->id)
                ->first();
            $totales_horas = $horaacumulada->total_horas ?? '00:00:00';
            
            // Reemplazar con el total calculado que incluye extras/descuentos si existe
            if (class_exists('\App\Models\TotalHora')) {
                $totalHora = \App\Models\TotalHora::where('id_inscripcion', $inscripcion->id)->first();
                if ($totalHora && $totalHora->total_horas) {
                    $totales_horas = $totalHora->total_horas;
                }
            }
        
            $pdf = Pdf::loadView('asistencias.pdf', compact('asistencias', 'inscripcion', 'totales_horas'))->setPaper('a4', 'landscape');
            return $pdf->stream();
        } else {
            abort(404, 'No se encontró inscripción para este usuario');
        }
    }
    

    /**
     * Show the form for creating a new resource.
     */
    public function createasistencia(Request $request)
    {
        $longitud = strlen($request->serie);
        $serial = substr($request->serie, 0, $longitud - 2);
        $fecha = ($request->fecha);
        $hora = ($request->hora);
        /*  $hora = '09:18:00'; */
        /*  $hora = '13:00:00'; */
        // Extraer la parte de la cadena desde el inicio hasta tres caracteres antes del final
        $asistencia = substr($request->serie, $longitud - 1, $longitud);
        $tarjeta = Tarjeta::where('serie', $serial)->first();
        $idInscripcion = $tarjeta->asignartarjeta->pluck('id_inscripcion')->first();
        $idMultas = Multa::where('p1', '<=', $hora)
            ->where('p2', '>=', $hora)
            ->pluck('id')->first();
        if ($asistencia == "E") {
            $asistencias = new Asistencia();
            $asistencias->fecha = $fecha;
            $asistencias->h_llegada = $hora;
            $asistencias->turno = "1";
            $asistencias->asistencia = 'A';
            $asistencias->id_inscripcion = $idInscripcion;
            $asistencias->id_actividad = 1;
            $asistencias->id_multa = $idMultas;
            $asistencias->estado = 2;
            // Lógica para determinar el estado según la hora de llegada
            /* $horaCarbon = Carbon::parse($hora);
            
            // Turno MAÑANA (09:00:00 - 13:00:59)
            if ($horaCarbon->between(Carbon::parse('08:00:00'), Carbon::parse('13:00:59'))) {
                if ($horaCarbon->between(Carbon::parse('09:11:00'), Carbon::parse('09:15:59'))) {
                    $asistencias->estado = 2; // Ninguno
                } elseif ($horaCarbon->gte(Carbon::parse('09:16:00'))) {
                    $asistencias->estado = 0; // Deuda
                }
            }
            // Turno TARDE (14:00:00 - 18:00:59)
            elseif ($horaCarbon->between(Carbon::parse('13:00:00'), Carbon::parse('18:00:59'))) {
                if ($horaCarbon->between(Carbon::parse('14:11:00'), Carbon::parse('14:15:59'))) {
                    $asistencias->estado = 2; // Ninguno
                } elseif ($horaCarbon->gte(Carbon::parse('14:16:00'))) {
                    $asistencias->estado = 0; // Deuda
                }
            } */

            $asistencias->save();
            /* return $idInscripcion; */
        } else {
            $salida = Asistencia::where('id_inscripcion', $idInscripcion)
                ->whereNull('h_salida')
                ->latest()
                ->first();
            if ($salida) {
                // Actualizar la hora de salida
                $salida->h_salida = $hora;
                // Calcular la diferencia de horas entre la hora de llegada y la hora de salida
                $horaLlegada = Carbon::parse($salida->h_llegada);
                $horaSalida = Carbon::parse($hora);
                $diferencia = $horaSalida->diff($horaLlegada);
                // Obtener la diferencia formateada en hora:minuto:segundo
                $diferenciaFormateada = $diferencia->format('%H:%I:%S');
                $salida->horas = $diferenciaFormateada;
                // Guardar la actualización
                $salida->save();
                /* $tarjeta = new Tarjeta();
            $tarjeta->serie = $diferenciaFormateada;
            $tarjeta->estado = 1;
            $tarjeta->save(); */
            }
        }
    }

    public function store(Request $request)
    {
        $asistencia = new Asistencia();
        /* dd($request); */
        $horallegada = $this->timeToHours($request->h_llegada ?? '00:00:00');
        $horasalida = $this->timeToHours($request->h_salida );
        $currentMinutes = $horasalida-$horallegada;

        // Calcula la diferencia en minutos, asegurando que no sea negativa
        $currentMinutes = max(0, $horasalida - $horallegada);

        // Actualiza los campos relevantes
        $asistencia->fecha = $request->fecha;
        $asistencia->h_llegada = $request->h_llegada ?? '00:00:00';
        $asistencia->h_salida = $request->h_salida ;
        $asistencia->turno = $request->turno;
        $asistencia->horas = $this->hoursToTime($currentMinutes);

        $asistencia->asistencia = $request->asistencia;
        $asistencia->id_inscripcion = $request->id_inscripcion;
        $asistencia->id_multa = $request->id_multa;
        $asistencia->id_actividad = $request->id_actividad;
        $asistencia->estado = $request->estado;

        $asistencia->save();
        return redirect()->route('asistencias.show', $request->id_inscripcion)->with('mensaje', 'Se registró la asistencia de la manera correcta');

    }

    /**
     * Display the specified resource.
     */
    public function show($id)
{
    // Verificar autenticación
    if (!Auth::check()) {
        Auth::logout();
        return redirect('/login');
    }

    $rol = Auth::user()->roles->first()->name;

    // Autorización: solo el dueño o roles superiores
    if ($id == Auth::user()->inscripciones->id && in_array($rol, ['Pasante', 'SubDirector']) 
        || in_array($rol, ['Super Administrador', 'Director', 'SubDirector', 'Gerente'])) {
        
        // Datos principales de la inscripción
        $inscripcions = Inscripcion::findOrFail($id);
        $asistencias = $inscripcions->asistencias;
        $tarjeta = Tarjeta::find($id);                   // O la que corresponda
        $asignartarjeta = AsignarTarjeta::find($id);

        // Horas acumuladas laborales
        $horaacumulada = Asistencia::select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(horas))) AS total_horas'))
            ->where('id_inscripcion', $id)
            ->first();

        // Horas académicas (conversión)
        $horaMultiplicar = '01:00:00';
        $horaDividir = '00:45:00';
        $horaResultado = Asistencia::selectRaw("TIME_FORMAT(SEC_TO_TIME(TIME_TO_SEC(SEC_TO_TIME(SUM(TIME_TO_SEC(horas)))) * TIME_TO_SEC('$horaMultiplicar') / TIME_TO_SEC('$horaDividir')), '%H:%i:%s') AS horas_academicas")
            ->where('id_inscripcion', $id)
            ->first();

        // Obtener TotalHora y RegistrosDescuentos con protección
        $totalHora = null;
        $registrosDescuentos = collect();

        if (class_exists('\App\Models\TotalHora')) {
            $totalHora = \App\Models\TotalHora::where('id_inscripcion', $id)->first();
        }
        if (class_exists('\App\Models\RegistroDescuento')) {
            $registrosDescuentos = \App\Models\RegistroDescuento::where('id_inscripcion', $id)->get();
        }

        // Si no hay registro, crear objeto vacío
        if (!$totalHora) {
            $totalHora = new \stdClass();
            $totalHora->asistencias_extras = 0;
            $totalHora->horas_descuento = 0;
            $totalHora->total_horas = $horaacumulada->total_horas ?? '00:00:00';
        }

        return view('asistencias.show', compact(
            'asistencias',
            'inscripcions',
            'asignartarjeta',
            'horaacumulada',
            'horaResultado',
            'tarjeta',
            'totalHora',
            'registrosDescuentos'
        ));
    }

    abort(403, 'No tienes permiso para ver esta asistencia.');
}

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $inscripcions = $asistencia->inscripciones;
        $multas = Inscripcion::all();
        $multas = Multa::all();
        $actividads = Actividad::all();
        return view('asistencias.edit', compact('asistencia', 'inscripcions', 'multas', 'actividads'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        $id_inscripcion = $request->query('id_inscripcion');
        //Log::info('Received id_inscripcion for update: ' . $id_inscripcion);

        $asistencia = Asistencia::where('id_inscripcion', $id_inscripcion)
            ->whereNull('salida')
            ->first();

        if ($asistencia) {
            $asistencia->salida = Carbon::now();
            $asistencia->save();

            return response()->json(['message' => 'Salida actualizada correctamente.']);
        } else {
            return response()->json(['message' => 'No se encontró registro de entrada.'], 404);
        }
    }


    function timeToHours($time)
    {
        /* $parts = explode(':', $time);
        return ($parts[0] * 60) + $parts[1]; // Convertir a minutos */

        if (empty($time) || strpos($time, ':') === false) {
            return 0; // o null, o false, según lo que prefieras retornar
        }
    
        $parts = explode(':', $time);
    
        // Validar que hay dos partes numéricas
        if (count($parts) < 2 || !is_numeric($parts[0]) || !is_numeric($parts[1])) {
            return 0; // o algún valor por defecto
        }
    
        return ($parts[0] * 60) + $parts[1];
    }

    function hoursToTime($totalMinutes)
    {
        $hours = floor($totalMinutes / 60);
        $minutes = $totalMinutes % 60;
        return sprintf('%02d:%02d:00', $hours, $minutes); // Formato HH:MM:SS
    }


    public function crearFields(Request $request, $id)
    {
                /* $asistencias = Asistencia::with('inscripcion')->get(); */
                $asistencias = Asistencia::all();
                $inscripcions = Inscripcion::find($id);
                $multas = Multa::all();
                $actividads = Actividad::all();
                $areas = Area::all();
                return view('asistencias.create', compact('asistencias', 'inscripcions', 'multas','actividads','areas'));
    }

    public function updateFields(Request $request, $id)
    {
        // Encuentra la asistencia por ID
        $asistencia = Asistencia::findOrFail($id);

        // Obtener la actividad seleccionada
        $actividad = Actividad::find($request->id_actividad);

        // Depuración: Verificar si el nombre de la actividad está llegando correctamente
        // dd($actividad->nombre_actividad);
        $currentMinutes = $this->timeToHours($request->horas);
        $horallegada = $this->timeToHours($request->h_llegada);
        $horasalida = $this->timeToHours($request->h_salida);

        if ($currentMinutes>=480) {
            $currentMinutes = 0;
            $diff = max(0, $horasalida - $horallegada); // Asegurar que no sea negativo
            //$currentMinutes = $currentMinutes+($horasalida-$horallegada);
            $currentMinutes = $currentMinutes + $diff;
        }

        // Verificar si el nombre de la actividad contiene la palabra "voluntariado"
        if (stripos($actividad->nombre_actividad, 'voluntariado') !== false and  $horasalida !== null and $horallegada !== null) {
            $currentMinutes = 240+($horasalida-$horallegada);
        }
        if (stripos($actividad->nombre_actividad, 'convocatoria') !== false and  $horasalida !== null and $horallegada !== null) {
            $currentMinutes = ($horasalida-$horallegada);
        }
        if (stripos($actividad->nombre_actividad, 'ninguna') !== false and  $horasalida !== null and $horallegada !== null) {
            $currentMinutes = ($horasalida-$horallegada);
        }

        // Actualiza los campos relevantes
        $asistencia->fecha = $request->fecha;
        $asistencia->h_llegada = $request->h_llegada ?? '00:00:00';
        $asistencia->h_salida = $request->h_salida;
        $asistencia->turno = $request->input('turno');
        //$asistencia->horas = $this->hoursToTime($currentMinutes);
        $asistencia->horas = $this->hoursToTime(max(0, $currentMinutes)); // Asegurar minutos no negativos

        // Campo de asistencia agregado (se descomentó la línea existente)
        $asistencia->asistencia = $request->input('asistencia');

        //$asistencia->asistencia = $request->input('asistencia');
        $asistencia->id_multa = $request->id_multa;
        $asistencia->id_actividad = $request->input('id_actividad');
        $asistencia->estado = $request->input('estado');

        // Guarda los cambios
        $asistencia->save();

        // Redirige al índice de asistencias con un mensaje de éxito
        return redirect()->route('asistencias.show', $request->id_inscripcion)->with('mensaje', 'Se edito la asistencia de la manera correcta');
    }





    /* public function update(Request $request, $id)
    {
        // Validación de los datos que vienen del formulario
        $request ->validate([
        'fecha' => 'required|date',
        'h_llegada' => 'required|date_format:H:i',
        'h_salida' => 'required|date_format:H:i',
        'horas' => 'required|numeric',
        'turno' => 'required|string',
        'asistencia' => 'required|string',
        'id_multa' => 'required|integer',
        'id_actividad' => 'required|integer',
        'estado' => 'required|string',
    ]);

        // Encontrar el registro de asistencia
        $asistencia = Asistencia::find($id);

        // Actualizar los campos con los datos validados
        $asistencia->fecha = $request->fecha;
        $asistencia->h_llegada = $request->h_llegada;
        $asistencia->h_salida = $request->h_salida;
        $asistencia->horas = $request->horas;
        $asistencia->turno = $request->turno;
        $asistencia->asistencia = $request->asistencia;
        $asistencia->id_multa = $request->id_multa;
        $asistencia->id_actividad = $request->id_actividad;
        $asistencia->estado = $request->estado;

        // Guardar los cambios en la base de datos
        $asistencia->save();

        // Redireccionar a la vista deseada con un mensaje de éxito
        return redirect('/asistencias')->with('success', 'Asistencia actualizada correctamente');
    } */

    /**
     * Remove the specified resource from storage.
     */
    public function destroy( $id,Request $request)
    {
        Asistencia::destroy($id);
        return back()->with('mensaje', 'Se elimino la asistencia de la manera correcta');
    }




}