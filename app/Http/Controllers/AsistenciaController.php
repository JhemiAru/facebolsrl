<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use App\Models\AsignarTarjeta;
use App\Models\Asistencia;
use App\Models\Informacion;
use App\Models\Inscripcion;
use App\Models\Tarjeta;
use App\Models\Multa;
use Illuminate\Http\Request;
use Carbon\Carbon;
/* use Illuminate\Support\Facades\Log; */

class AsistenciaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        /* $asistencias = Asistencia::with('inscripcion')->get(); */
        $asistencias = Asistencia::all();
        $inscripcions = Inscripcion::all();
        $multas = Inscripcion::all();
        return view('asistencias.index', compact('asistencias', 'inscripcions', 'multas'));
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
            $asistencias->estado = 0;
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
        $id_inscripcion = $request->query('id_inscripcion');
        /* Log::info('Received id_inscripcion for store: ' . $id_inscripcion); */

        $asistencia = new Asistencia();
        $asistencia->id_inscripcion = $id_inscripcion;
        $asistencia->entrada = Carbon::now();
        /* dd($asistencia); */



        $asistencia->save();
        return response()->json(['message' => 'Nueva entrada registrada correctamente.']);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        /* Carbon::setLocale('es'); */
        /* $asistencias=$id */
        $inscripcion = Inscripcion::with('asistencias')->find($id)->asistencias;
        $asistencias = $inscripcion;
        $inscripcions = Inscripcion::find($id);
        $tarjeta = Tarjeta::find($id);
        $asignartarjeta = AsignarTarjeta::find($id);
        // Obtener la suma total de horas en formato de tiempo
                $horaacumulada = Asistencia::select(DB::raw('SEC_TO_TIME(SUM(TIME_TO_SEC(horas))) AS total_horas'))
                ->where('id_inscripcion', $id)
                ->first();

                // Definir la hora a multiplicar ('01:00:00') y la hora a dividir ('00:45:00')
                $horaMultiplicar = '01:00:00';
                $horaDividir = '00:45:00';

                // Realizar la multiplicación y división en formato de tiempo, y extraer en formato de hora
                $horaResultado = Asistencia::selectRaw("TIME_FORMAT(SEC_TO_TIME(TIME_TO_SEC(SEC_TO_TIME(SUM(TIME_TO_SEC(horas)))) * TIME_TO_SEC('$horaMultiplicar') / TIME_TO_SEC('$horaDividir')), '%H:%i:%s') AS horas_academicas")
                ->where('id_inscripcion', $id)
                ->first();
            return view('asistencias.show', compact('asistencias', 'inscripcions', 'asignartarjeta','horaacumulada','horaResultado','tarjeta'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $asistencia = Asistencia::find($id);
        $inscripcions = Inscripcion::all();
        $multas = Inscripcion::all();
        return view('asistencias.edit', compact('asistencia', 'inscripcions', 'multas'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Asistencia $asistencia)
    {
        $id_inscripcion = $request->query('id_inscripcion');
        /* Log::info('Received id_inscripcion for update: ' . $id_inscripcion); */

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

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Asistencia $asistencia)
    {
        //
    }
}
