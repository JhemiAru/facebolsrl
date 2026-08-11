<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\TotalHora;

class AsistenciaJsonController extends Controller
{
    private $file = 'asistencias.json';

  public function guardar(Request $request, $id)
{
    try {
        $data = [];
        if (Storage::exists($this->file)) {
            $data = json_decode(Storage::get($this->file), true) ?? [];
        }

        $valoresActuales = $data[$id] ?? ['asistencias' => 0, 'descuentos' => 0];
        $asistenciasExtras = $request->has('asistencias') ? (int)$request->input('asistencias') : (int)$valoresActuales['asistencias'];
        
        // 1. Obtener el registro actual de la base de datos o crear uno nuevo vacío
        $totalHoraBD = TotalHora::firstOrNew(['id_inscripcion' => $id]);

        if (!$totalHoraBD->exists) {
            $totalHoraBD->total_horas = '00:00:00';
            $totalHoraBD->horas_academicas = '00:00:00';
        }

        // Actualizar asistencias extras si vienen en la petición
        if ($request->has('asistencias')) {
            $totalHoraBD->asistencias_extras = $asistenciasExtras;
        }

        // 2. Mapear y guardar el motivo específico si viene en la petición
        $motivo = $request->input('motivo');
        $valorDescuento = (int)$request->input('descuentos', 0);

        $mapaColumnas = [
            'atrasos'    => 'detalle_atraso_descuento',
            'informe'    => 'detalle_informe_descuento',
            'uniforme'   => 'detalle_uniforme_descuento',
            'credencial' => 'detalle_credencial_descuento',
            'limpieza'   => 'detalle_limpieza_descuento',
            'faltas'     => 'detalle_falta_descuento',
        ];

        if ($request->has('descuentos') && array_key_exists($motivo, $mapaColumnas)) {
            $columna = $mapaColumnas[$motivo];
            $totalHoraBD->$columna = $valorDescuento;
        }

        // 3. Recalcular automáticamente el total de la columna `horas_descuento`
        $totalHoraBD->horas_descuento = 
            (int)$totalHoraBD->detalle_atraso_descuento +
            (int)$totalHoraBD->detalle_informe_descuento +
            (int)$totalHoraBD->detalle_uniforme_descuento +
            (int)$totalHoraBD->detalle_credencial_descuento +
            (int)$totalHoraBD->detalle_limpieza_descuento +
            (int)$totalHoraBD->detalle_falta_descuento;

        // Guardamos en la base de datos
        $totalHoraBD->save();

        // 4. Sincronizar archivo JSON de respaldo
        $data[$id] = [
            'asistencias' => $totalHoraBD->asistencias_extras,
            'descuentos'  => $totalHoraBD->horas_descuento,
        ];
        Storage::put($this->file, json_encode($data, JSON_PRETTY_PRINT));

        return response()->json([
            'success' => true,
            'motivo' => $motivo,
            'horas_en_campo' => $valorDescuento,
            'horas_descuento_total' => $totalHoraBD->horas_descuento,
            // Si calculas dinámicamente el nuevo total de horas réstale el descuento aquí
            'nuevo_total_laborales' => $totalHoraBD->total_horas 
        ]);

    } catch (\Exception $e) {
        return response()->json([
            'success' => false,
            'message' => 'Error: ' . $e->getMessage()
        ], 500);
    }
}

    // Obtener asistencias/desc.
    public function obtener($id)
    {
        if (!Storage::exists($this->file)) {
            return response()->json(['asistencias' => 0, 'descuentos' => 0]);
        }

        $data = json_decode(Storage::get($this->file), true) ?? [];

        return response()->json($data[$id] ?? ['asistencias' => 0, 'descuentos' => 0]);
    }
}