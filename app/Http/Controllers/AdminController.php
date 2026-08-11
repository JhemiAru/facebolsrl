<?php

namespace App\Http\Controllers;

use App\Models\Area;
use App\Models\Asistencia;
use App\Models\Certificado;
use App\Models\Generacion;
use App\Models\Informacion;
use App\Models\Inscripcion;
use App\Models\Tarjeta;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminController extends Controller
{
    public function index()
    {
        // Consultas existentes (mantener igual)
        $usuarios = User::all();
        $informacions = Informacion::all();
        $inscripcions = Inscripcion::all();
        $areas = Area::all();
        $generacions = Generacion::all();
        $tarjetas = Tarjeta::all();
        $asistencias = Asistencia::all();
        $certificados = Certificado::all();

        // Consulta para gráfico de inscripciones por mes
        $inscripcionesPorMes = Inscripcion::select(
                DB::raw('MONTH(created_at) as mes'),
                DB::raw('COUNT(*) as total')
            )
            ->whereYear('created_at', date('Y'))
            ->groupBy('mes')
            ->orderBy('mes')
            ->get();

        // Consulta para instituciones universitarias
        $instituciones = Informacion::select(
                'insti_univer',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('insti_univer')
            ->orderBy('total', 'DESC')
            ->limit(15)
            ->get();

        // Consulta para carreras más comunes
        $carreras = Informacion::select(
                'carrera',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('carrera')
            ->orderBy('total', 'DESC')
            ->limit(8)
            ->get();

        // Consulta para distribución por año
        $anios = Informacion::select(
                'año',
                DB::raw('COUNT(*) as total')
            )
            ->groupBy('año')
            ->orderBy('año')
            ->get();

        // Mapeo de meses
        $meses = [
            1 => 'Enero', 2 => 'Febrero', 3 => 'Marzo', 4 => 'Abril',
            5 => 'Mayo', 6 => 'Junio', 7 => 'Julio', 8 => 'Agosto',
            9 => 'Septiembre', 10 => 'Octubre', 11 => 'Noviembre', 12 => 'Diciembre'
        ];

        return view('index', compact(
            'usuarios', 'informacions', 'inscripcions', 'areas',
            'generacions', 'tarjetas', 'asistencias', 'certificados',
            'instituciones', 'carreras', 'anios', 'meses',
            'inscripcionesPorMes'
        ));
    }
}