<?php

namespace App\Http\Controllers;

use App\Models\AjusteHora;
use Illuminate\Http\Request;

class AjusteHoraController extends Controller
{
     // Obtener datos existentes
    public function obtener($id)
    {
        $ajuste = AjusteHora::where('id_inscripcion', $id)->first();

        return response()->json([
            'asistencias_extras' => $ajuste->asistencias_extras ?? 0,
            'descuento_horas' => $ajuste->descuento_horas ?? 0,
        ]);
    }

    public function guardarExtra(Request $request, $id)
    {
        $validated = $request->validate([
            'asistencias' => 'required|integer|min:0',
        ]);

        $ajuste = AjusteHora::updateOrCreate(
            ['inscripcion_id' => $id],
            ['asistencias_extras' => $validated['asistencias']]
        );

        return response()->json(['success' => true]);
    }

    public function guardarDescuento(Request $request, $id)
    {
        $validated = $request->validate([
            'descuento' => 'required|integer|min:0',
        ]);

        $ajuste = AjusteHora::updateOrCreate(
            ['inscripcion_id' => $id],
            ['descuento_horas' => $validated['descuento']]
        );

        return response()->json(['success' => true]);
    }
}
