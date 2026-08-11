<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\CronSchedule;

class CronScheduleController extends Controller
{
    // Mostrar el formulario de edición
    public function edit()
    {
        $cronSchedule = CronSchedule::first(); // Obtenemos la configuración actual
        return view('cron_schedule.edit', compact('cronSchedule'));
    }

    // Actualizar la hora de ejecución
    public function update(Request $request)
    {
        // Validar que la entrada sea un formato de hora válido
        $request->validate([
            'hora_ejecucion' => 'required|date_format:H:i',
        ]);

        // Actualizar la configuración en la base de datos
        $cronSchedule = CronSchedule::first();
        if ($cronSchedule) {
            $cronSchedule->update(['hora_ejecucion' => $request->hora_ejecucion]);
        } else {
            CronSchedule::create(['hora_ejecucion' => $request->hora_ejecucion]);
        }

        return redirect()->back()->with('success', 'Hora de ejecución actualizada correctamente');
    }
}

