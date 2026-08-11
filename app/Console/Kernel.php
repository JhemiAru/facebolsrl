<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;
use Illuminate\Support\Facades\DB;


class Kernel extends ConsoleKernel
{
    protected $commands = [
        \App\Console\Commands\RegistrarFaltasAsistencias::class,
    ];

    protected function schedule(Schedule $schedule)
    {
        // Ejecutar el comando todos los días en el horario configurado (días laborales)
        $horarioEjecucion = DB::table('cron_schedules')->value('hora_ejecucion');
        $schedule->command('asistencias:registrar-faltas')->weekdays()->at($horarioEjecucion);
    }

    protected function commands()
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
