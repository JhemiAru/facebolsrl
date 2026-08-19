<?php

namespace App\Http\Controllers;

use App\Models\Punto;
use Illuminate\Http\Request;

class PuntoController extends Controller
{
    public function guardarPuntos(Request $request, $id)
    {
        // Verificar si es administrativa@facebolsrl.net
        if (!auth()->check() || auth()->user()->email !== 'administrativa@facebolsrl.net') {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para añadir puntos.'
            ], 403);
        }

        // Validamos los datos entrantes
        $request->validate([
            'puntos_ganados' => 'required|integer|not_in:0',
            'descripcion' => 'required|string|max:255'
        ]);

        // Sumamos los puntos actuales de esta inscripción
        $puntosActuales = Punto::where('id_inscripcion', $id)->sum('puntos_ganados');


        // Guardamos los puntos
        Punto::create([
            'id_inscripcion' => $id,
            'puntos_ganados' => $request->puntos_ganados,
            'descripcion' => strtoupper($request->descripcion)
        ]);

        $nuevoTotal = $puntosActuales + $request->puntos_ganados;

        return response()->json([
            'success' => true,
            'nuevo_total' => $nuevoTotal,
            'message' => 'Puntos extra registrados correctamente.'
        ]);
    }

    public function eliminarPuntos(Request $request)
    {
        if (!auth()->check() || auth()->user()->email !== 'administrativa@facebolsrl.net') {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para eliminar puntos.'
            ], 403);
        }

        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'integer|exists:puntos,id'
        ]);

        Punto::whereIn('id', $request->ids)->delete();

        return response()->json([
            'success' => true,
            'message' => 'Puntos eliminados correctamente.'
        ]);
    }

    public function modificarPunto(Request $request, $id)
    {
        if (!auth()->check() || auth()->user()->email !== 'administrativa@facebolsrl.net') {
            return response()->json([
                'success' => false,
                'message' => 'No tienes permisos para modificar puntos.'
            ], 403);
        }

        $request->validate([
            'puntos_ganados' => 'required|integer|not_in:0',
            'descripcion' => 'required|string|max:255'
        ]);

        $punto = Punto::findOrFail($id);
        $punto->update([
            'puntos_ganados' => $request->puntos_ganados,
            'descripcion' => strtoupper($request->descripcion)
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Punto modificado correctamente.'
        ]);
    }
}