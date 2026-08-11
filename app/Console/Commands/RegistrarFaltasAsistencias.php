<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Asistencia;
use App\Models\Inscripcion;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class RegistrarFaltasAsistencias extends Command
{
    // Nombre y descripción del comando
    protected $signature = 'asistencias:registrar-faltas';
    protected $description = 'Registrar automáticamente faltas de asistencia para quienes no marcaron asistencia antes del tiempo límite';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Definir la fecha y la hora actual
        $fechaActual = Carbon::now()->toDateString();
        $horaActual = Carbon::now()->toTimeString();

        // Obtener el horario límite de la configuración (desde la tabla `cron_schedules`)
        $horarioLimite = DB::table('cron_schedules')->value('hora_ejecucion');

        // Buscar las inscripciones activas que no tienen asistencia en la fecha actual
        $personasSinAsistencia = Inscripcion::where('estado', 'activo') // Filtrar solo inscripciones activas
            ->whereDoesntHave('asistencias', function ($query) use ($fechaActual) {
                $query->where('fecha_asistencia', $fechaActual);
            })->get();

        // Procesar cada inscripción sin asistencia registrada
        foreach ($personasSinAsistencia as $inscripcion) {
            // Verificar si la hora actual es mayor que el límite
            if ($horaActual > $horarioLimite) {
                // Registrar falta de asistencia
                Asistencia::create([
                    'fecha' => $fechaActual,
                    'h_llegada' => '00:00:00',
                    'h_salida'=> '00:00:00', // Campo que puede ser nulo
                    'horas' => '00:00:00', // Sin horas trabajadas
                    'turno' => '1',
                    'asistencia'  => 'F',
                    'id_inscripcion' => $inscripcion->id,
                    'id_actividad'  => 1,
                    'id_multa'  => 5,
                    'estado' => 0,

                ]);
            }
        }

        $this->info('Se han registrado las faltas de asistencia.');
    }
}
