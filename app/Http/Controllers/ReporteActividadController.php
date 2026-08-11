<?php

namespace App\Http\Controllers;

use App\Models\Actividad;
use App\Models\Area;
use App\Models\Asistencia;
use App\Models\Informacion;
use App\Models\Inscripcion;
use App\Models\Reporteactividad;
use Illuminate\Support\Facades\Auth;

use App\Models\User;
use Codedge\Fpdf\Fpdf\Fpdf;
use Illuminate\Http\Request;
//conexion a la base de datos
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Illuminate\Support\Facades\Log;

class ReporteActividadController extends Controller
{
    public function reporteactividad()
    {

        /* $reporteactividades = Reporteactividad::with('asistencia.inscripciones.informacion')->get();
        $asistencias = Asistencia::all();
        $informacions = Informacion::all();
        $inscripcions = Inscripcion::all();
        return view('asistencias.reporteactividad', compact('reporteactividades','inscripcions','informacions','asistencias')); */

        /* $reporteactividades = Reporteactividad::with('asistencia.inscripciones.informacion')->get();
        //dd($reporteactividades->first());
        return view('asistencias.reporteactividad', compact('reporteactividades')); */
        /* $user = Auth::user(); // Usuario autenticado
        $id_asistencia = $user->id_asistencia;

        if ($id) {
            $reporteactividades = Reporteactividad::with('asistencia.inscripciones.informacion')
                ->where('id_asistencia', $id)
                ->get();
        
            $asistencias = Asistencia::where('id', $id)->get();
            $inscripcions = Inscripcion::where('id_asistencia', $id)->get();
            $informacions = Informacion::whereHas('inscripciones', function ($query) use ($id) {
                $query->where('id_asistencia', $id);
            })->get();
        }
          else {
            // Mostrar todos los registros (vista general)
            $reporteactividades = Reporteactividad::with('asistencia.inscripciones.informacion')->get();
            $asistencias = Asistencia::all();
            $inscripcions = Inscripcion::all();
            $informacions = Informacion::all();
        }

        return view('asistencias.reporteactividad', compact('reporteactividades', 'inscripcions', 'informacions', 'asistencias')); */

        $user = Auth::user();

        if ($user->rol === 'Super Administrador') {
            $reporteactividades = Reporteactividad::with('asistencia.inscripcion.informacion')->get();
            $asistencias = Asistencia::all();
            $informacions = Informacion::all();
            $inscripcions = Inscripcion::all();
        } else {
            $codigo = $user->codigo_credencial;

            $inscripcion = Inscripcion::where('codigo_credencial', $codigo)->first();

            if (!$inscripcion) {
                abort(404, 'No se encontró inscripción para este usuario.');
            }

            $reporteactividades = Reporteactividad::with('asistencia.inscripcion.informacion')
                ->get()
                ->filter(function ($reporte) use ($inscripcion) {
                    return $reporte->asistencia && $reporte->asistencia->id_inscripcion == $inscripcion->id;
                });

            $asistencias = Asistencia::where('id_inscripcion', $inscripcion->id)->get();
            $informacions = collect([$inscripcion->informacion]);
            $inscripcions = collect([$inscripcion]);
        }

        return view('asistencias.reporteactividad', compact(
            'reporteactividades',
            'inscripcions',
            'informacions',
            'asistencias'
        ));
    }

    public function create()
    {
        /* $asistencias = Asistencia::first(); // Devuelve una sola inscripción
        
        return view('reporteactividades.create', compact('asistencias')); */

        $asistencias = Asistencia::first(); // Devuelve una colección

        return view('asistencias.reporteactividad', compact('asistencias'));
    }


    public function guardarActividad(Request $request)
    {

        /* dd($request->id_asistencia); */
        /* $reporteactividad = request()->all();
        return response()->json($reporteactividad); */

        // Verificar si id_asistencia está presente y no es null
        if (!$request->id_asistencia) {
            return back()->with('error', 'El campo ID de asistencia es obligatorio.');
        }

        $reporteactividad = new Reporteactividad();
        $reporteactividad->id_asistencia = $request->id_asistencia;
        $reporteactividad->mesLiteral = $request->mesLiteral;
        $reporteactividad->semana = $request->semana;
        $reporteactividad->turno = $request->turno;
        $reporteactividad->admin = strtoupper($request->director_titulo . ' ' . $request->director_nombre);
        $reporteactividad->f1 = $request->f1;
        $reporteactividad->actividade1 = $request->actividade1;
        $reporteactividad->f2 = $request->f2;
        $reporteactividad->actividade2 = $request->actividade2;
        $reporteactividad->f3 = $request->f3;
        $reporteactividad->actividade3 = $request->actividade3;
        $reporteactividad->f4 = $request->f4;
        $reporteactividad->actividade4 = $request->actividade4;
        $reporteactividad->f5 = $request->f5;
        $reporteactividad->actividade5 = $request->actividade5;

        // Extraer el número de semana del campo semana ("Semana X")
        $numeroSemana = str_replace('Semana ', '', $request->semana);

        // Construir la conclusión con los textos al inicio y al final
        $textoInicio = "El desarrollo de las diferentes actividades realizadas dentro de la empresa FaceBol S.R.L. Durante la semana {$numeroSemana}, se logró avanzar en actividades de formación. ";
        $textoCierre = "Sin otro particular me despido con las consideraciones más distinguidas, deseándole éxitos en las actividades que desempeña en favor de la empresa.";

        $reporteactividad->conclusion = $textoInicio . $request->conclusion . "\n" . $textoCierre;

        $reporteactividad->save();

        return redirect()->route('asistencias.reporteactividad', ['id_asistencia' => $reporteactividad->id_asistencia])
            ->with('mensaje', 'Se registró el Reporte Actividad correctamente');
    }


    public function editarActividad($id)
    {
        $reporteactividad = Reporteactividad::findOrFail($id);
        //dd($reporteactividad);
        // Si no hay asistencias, devolver una colección vacía
        $asistencias = Asistencia::all();
        return view('asistencias.editaractividad', compact('reporteactividad', 'asistencias'));
    }

    public function actualizarActividad(Request $request, $id)
    {
        $request->validate([
            'id_asistencia' => 'required|exists:asistencias,id', // Asegura que exista en la tabla asistencias
            'mesLiteral' => 'required',
            'semana' => 'required',
            'turno' => 'required',
            'director_area' => 'required',
            'director_area_nombre' => 'required',
            'f1' => 'nullable|date',
            'actividade1' => 'nullable|string',
            'f2' => 'nullable|date',
            'actividade2' => 'nullable|string',
            'f3' => 'nullable|date',
            'actividade3' => 'nullable|string',
            'f4' => 'nullable|date',
            'actividade4' => 'nullable|string',
            'f5' => 'nullable|date',
            'actividade5' => 'nullable|string',
            'conclusion' => 'nullable|string',
        ]);

        $reporteactividad = Reporteactividad::find($id);

        $reporteactividad->id_asistencia = $request->id_asistencia;
        $reporteactividad->mesLiteral = $request->mesLiteral;
        $reporteactividad->semana = $request->semana;
        $reporteactividad->turno = $request->turno;
        $reporteactividad->admin = strtoupper($request->director_area . ' ' . $request->director_area_nombre);
        $reporteactividad->f1 = $request->f1;
        $reporteactividad->actividade1 = $request->actividade1;
        $reporteactividad->f2 = $request->f2;
        $reporteactividad->actividade2 = $request->actividade2;
        $reporteactividad->f3 = $request->f3;
        $reporteactividad->actividade3 = $request->actividade3;
        $reporteactividad->f4 = $request->f4;
        $reporteactividad->actividade4 = $request->actividade4;
        $reporteactividad->f5 = $request->f5;
        $reporteactividad->actividade5 = $request->actividade5;

        // Si se proporciona conclusión, mantenerla o actualizarla
        if ($request->has('conclusion')) {
            // Extraer el número de semana del campo semana ("Semana X")
            $numeroSemana = str_replace('Semana ', '', $request->semana);

            // Construir la conclusión con los textos al inicio y al final
            $textoInicio = "El desarrollo de las diferentes actividades realizadas dentro de la empresa FaceBol S.R.L. Durante la semana {$numeroSemana}, se logró avanzar en actividades de formación. ";
            $textoCierre = "Sin otro particular me despido con las consideraciones más distinguidas, deseándole éxitos en las actividades que desempeña en favor de la empresa.";

            $reporteactividad->conclusion = $textoInicio . $request->conclusion . "\n" . $textoCierre;
        }

        $reporteactividad->save();
        // dd($reporteactividad);

        return redirect()->route('asistencias.reporteactividad')->with('mensaje', 'Reporte actualizado correctamente');
    }

    /*  public function details($id)
    {
        $reporteactividad = Reporteactividad::findOrFail($id);
        return view('asistencias.details', compact('reporteactividad'));
    } */

    public function eliminarActividad($id)
    {
        Reporteactividad::destroy($id);
        return redirect()->route('reporteactividad')->with('mensaje', 'Se elimino el reporte de actividad de la manera correcta');
    }

    public function enviarInforme(Request $request, $id)
    {
        $request->validate([
            'remitente' => 'required|email',
            'destinatario' => 'required|email',
            'asunto' => 'required|string',
            'contenido' => 'required|string',
        ]);

        $reporteactividad = Reporteactividad::with('asistencia.inscripcion.informacion')->findOrFail($id);
        $inscripcion = $reporteactividad->asistencia->inscripcion;
        $informacion = $inscripcion->informacion;

        // Generar el PDF en memoria
        $pdf = $this->generarPdfString($id);

        // Crear nombre del archivo
        $nombreArchivo = 'Reporte_Actividad_Semana_' . str_replace('Semana ', '', $reporteactividad->semana) . '_' . $informacion->nombre . '.pdf';

        // Guardar temporalmente el PDF
        $rutaTemporal = storage_path('app/temp/' . $nombreArchivo);

        // Crear directorio si no existe
        if (!file_exists(storage_path('app/temp'))) {
            mkdir(storage_path('app/temp'), 0755, true);
        }

        file_put_contents($rutaTemporal, $pdf);

        // Datos para el correo
        $datosCorreo = [
            'remitente' => $request->remitente,
            'asunto' => $request->asunto,
            'contenido' => $request->contenido,
        ];

        // Enviar el correo
        try {
            // Pequeño delay para evitar que Gmail marque como spam
            usleep(500000); // 0.5 segundos

            \Illuminate\Support\Facades\Mail::to($request->destinatario)
                ->send(new \App\Mail\EnviarInforme($datosCorreo, $informacion->nombre, $rutaTemporal, $nombreArchivo));

            // Pequeño delay antes de eliminar el archivo
            usleep(200000); // 0.2 segundos

            // Eliminar archivo temporal
            if (file_exists($rutaTemporal)) {
                unlink($rutaTemporal);
            }

            return response()->json([
                'success' => true,
                'message' => 'Correo enviado exitosamente'
            ]);
        } catch (\Exception $e) {
            // Eliminar archivo temporal en caso de error
            if (file_exists($rutaTemporal)) {
                unlink($rutaTemporal);
            }
            Log::error('Error al enviar correo: ' . $e->getMessage());
            return response()->json([
                'success' => false,
                'message' => 'Error al enviar el correo. Por favor, verifique la dirección e intente nuevamente.'
            ], 500);
        }
    }

    private function generarPdfString($id)
    {
        $reporteactividad = Reporteactividad::with('asistencia.inscripcion.informacion')->findOrFail($id);
        $inscripcion = $reporteactividad->asistencia->inscripcion;
        $area = Area::find($inscripcion->id_area);

        return $this->generarPdfInterno($id, 'S');
    }

    public function generarPdf($id)
    {
        return $this->generarPdfInterno($id, 'I');
    }

    private function generarPdfInterno($id, $outputMode = 'I')
    {
        $reporteactividad = Reporteactividad::with('asistencia.inscripcion.informacion')->findOrFail($id);

        $inscripcion = $reporteactividad->asistencia->inscripcion;
        $area = Area::find($inscripcion->id_area);
        $informacion = $inscripcion->informacion;

        // Limpiar el nombre del área quitando prefijos de jerarquía (D de Director, S de Subdirector)
        $nombreAreaLimpio = $area->nombre_area;
        // Quitar "D" al inicio si va seguida de mayúscula (ej: DFINANZAS -> FINANZAS)
        if (preg_match('/^D([A-Z])/', $nombreAreaLimpio)) {
            $nombreAreaLimpio = substr($nombreAreaLimpio, 1);
        }
        // Quitar "S" duplicada al inicio (ej: SSISTEMAS -> SISTEMAS)
        if (preg_match('/^SS/', $nombreAreaLimpio)) {
            $nombreAreaLimpio = substr($nombreAreaLimpio, 1);
        }

        // Crear PDF con FPDF y sobrescribir el método Header para agregar la imagen en todas las páginas
        $pdf = new class extends Fpdf {
            public function Header()
            {
                $imagePath = base_path('public/vendor/adminlte/dist/img/CertificadoMembretado.jpg');
                if (file_exists($imagePath)) {
                    $this->Image($imagePath, 0, 0, 215, 300, 'JPG');
                }

                // Establecer margen superior para páginas siguientes
                if ($this->PageNo() > 1) {
                    $this->SetY(42); // Margen superior de 30mm para páginas siguientes
                }
            }
        };

        $pdf->AddPage();

        // Título INFORME
        $pdf->SetFont('Times', 'BU', 12);
        $pdf->SetXY(20, 30);
        $pdf->Cell(175, 10, utf8_decode('INFORME'), 0, 0, 'C');

        // Tabla INFORME pequeña (más pequeña y centrada)
        // A:
        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetXY(70, 45);
        $pdf->Cell(10, 4, 'A:', 0, 1, 'R');

        $pdf->SetFont('Times', '', 10);
        $pdf->SetXY(80, 45);
        $pdf->Cell(80, 4, utf8_decode(strtoupper($reporteactividad->admin)), 0, 1, 'L');

        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetX(80);
        $pdf->Cell(80, 4, utf8_decode('DIRECTOR/A DEL ÁREA DE ' . $nombreAreaLimpio), 0, 1, 'L');

        // Verificar si el nombre contiene "aux" para determinar el cargo
        $nombreCompleto = $informacion->nombre . ' ' . $informacion->apellido_paterno . ' ' . $informacion->apellido_materno;
        $cargo = (stripos($nombreCompleto, 'aux') !== false) ? 'AUXILIAR' : 'PASANTE';
        // Quitar "AUX" del nombre (case insensitive) y convertir a mayúsculas
        $nombreCompleto = strtoupper(trim(preg_replace('/\baux\.?\b/i', '', $nombreCompleto)));

        // DE:
        $pdf->SetFont('Times', 'B', 10);
        $yPosDe = $pdf->GetY();
        $pdf->SetXY(70, $yPosDe);
        $pdf->Cell(10, 4, 'DE:', 0, 1, 'R');

        $pdf->SetFont('Times', '', 10);
        $pdf->SetXY(80, $yPosDe);
        $pdf->Cell(80, 4, utf8_decode($nombreCompleto), 0, 1, 'L');

        $pdf->SetFont('Times', 'B', 10);
        $pdf->SetXY(80, $yPosDe + 4);
        $pdf->Cell(80, 4, utf8_decode($cargo . ' DEL ÁREA DE ' . $nombreAreaLimpio), 0, 1, 'L');

        // FECHA:
        $fechaHoy = Carbon::now()->locale('es')->isoFormat('D [de] MMMM [de] YYYY');
        $pdf->SetFont('Times', 'B', 10);
        $yPosFecha = $pdf->GetY();
        $pdf->SetXY(64.5, $yPosFecha);
        $pdf->Cell(20, 4, 'FECHA:', 0, 1, 'L');

        $pdf->SetFont('Times', '', 10);
        $pdf->SetXY(80, $yPosFecha);
        $pdf->Cell(80, 4, utf8_decode($fechaHoy), 0, 1, 'L');

        // ANTECEDENTES
        $pdf->SetFont('Times', 'B', 12);
        $pdf->SetXY(20, 70);
        $pdf->Cell(10, 8, '1.', 0, 0, 'L');
        $pdf->Cell(165, 8, 'ANTECEDENTES', 0, 1, 'L');

        $fechaInscripcion = Carbon::parse($inscripcion->f_inscripcion)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

        $pdf->SetFont('Times', '', 11);
        $pdf->SetXY(20, 78);
        $pdf->MultiCell(175, 5, utf8_decode('Habiéndome incorporado a la empresa FaceBol S.R.L. en fecha ' . $fechaInscripcion . ', y en cumplimiento a instructiva de la empresa, para el desarrollo de distintas actividades respectivas del Área de ' . ucwords(strtolower($nombreAreaLimpio)) . ', tengo a bien informar lo siguiente.'), 0, 'J');

        // ACTIVIDADES DESARROLLADAS
        $pdf->SetFont('Times', 'B', 12);
        $yPos = $pdf->GetY() + 5;
        $pdf->SetXY(20, $yPos);
        $pdf->Cell(10, 8, '2.', 0, 0, 'L');
        $pdf->Cell(165, 8, 'ACTIVIDADES DESARROLLADAS', 0, 1, 'L');

        // Calcular rango de fechas
        $fechas = collect([
            $reporteactividad->f1,
            $reporteactividad->f2,
            $reporteactividad->f3,
            $reporteactividad->f4,
            $reporteactividad->f5,
        ])->filter()->map(function ($fecha) {
            return Carbon::parse($fecha);
        });

        if ($fechas->isNotEmpty()) {
            $fechaInicio = $fechas->min();
            $fechaFin = $fechas->max();

            if ($fechaInicio->month === $fechaFin->month && $fechaInicio->year === $fechaFin->year) {
                $rangoFechas = $fechaInicio->day . ' al ' . $fechaFin->day . ' de ' . $fechaFin->locale('es')->isoFormat('MMMM');
            } else {
                $rangoFechas = $fechaInicio->day . ' de ' . $fechaInicio->locale('es')->isoFormat('MMMM') .
                    ' al ' . $fechaFin->day . ' de ' . $fechaFin->locale('es')->isoFormat('MMMM');
            }
        } else {
            $rangoFechas = 'fechas no especificadas';
        }

        $numeroSemana = preg_replace('/[^0-9]/', '', $reporteactividad->semana);

        $pdf->SetFont('Times', '', 11);
        $yPos = $pdf->GetY() + 3;
        $pdf->SetXY(20, $yPos);
        $horario = $reporteactividad->turno === 'Mañana' ? '09:00 a 13:00' : ($reporteactividad->turno === 'Tarde' ? '14:00 a 18:00' : '09:00 a 18:00');
        $pdf->MultiCell(175, 5, utf8_decode('Las actividades realizadas en la empresa FaceBol S.R.L. por mi persona en el Turno ' . strtolower($reporteactividad->turno) . ', horario de ' . $horario . ', modalidad presencial, correspondiente a fechas del ' . $rangoFechas . ' de mi semana laboral número ' . $numeroSemana . ' son las siguientes:'), 0, 'J');

        // Tabla de actividades
        $yPos = $pdf->GetY() + 5;
        $pdf->SetXY(20, $yPos);

        // Header SEMANA X (color #155F82)
        $pdf->SetFillColor(21, 95, 130); // #155F82
        $pdf->SetTextColor(255, 255, 255);
        $pdf->SetFont('Times', 'B', 11);
        $pdf->Cell(175, 8, utf8_decode('SEMANA ' . $numeroSemana), 1, 1, 'C', true);

        // Headers de columnas (color #074F6A)
        $pdf->SetFillColor(7, 79, 106); // #074F6A
        $pdf->SetXY(20, $pdf->GetY());
        $pdf->Cell(25, 8, 'FECHA', 1, 0, 'C', true);
        $pdf->Cell(80, 8, 'ACTIVIDAD', 1, 0, 'C', true);
        $pdf->Cell(45, 8, 'SUPERVISOR', 1, 0, 'C', true);
        $pdf->Cell(25, 8, 'OBS.', 1, 1, 'C', true);

        // Datos de actividades
        $pdf->SetTextColor(0, 0, 0);
        $pdf->SetFont('Times', '', 10);

        $actividades = [
            ['fecha' => $reporteactividad->f1, 'actividad' => $reporteactividad->actividade1],
            ['fecha' => $reporteactividad->f2, 'actividad' => $reporteactividad->actividade2],
            ['fecha' => $reporteactividad->f3, 'actividad' => $reporteactividad->actividade3],
            ['fecha' => $reporteactividad->f4, 'actividad' => $reporteactividad->actividade4],
            ['fecha' => $reporteactividad->f5, 'actividad' => $reporteactividad->actividade5],
        ];

        $supervisor = ucwords(strtolower($reporteactividad->admin)) . "\n" . ucwords(strtolower('Área de ' . $nombreAreaLimpio));
        foreach ($actividades as $act) {
            if ($act['fecha'] && $act['actividad']) {
                // Calcular la altura necesaria para la actividad
                $actividadTexto = utf8_decode($act['actividad']);
                $anchoActividad = 80;

                // Dividir el texto por saltos de línea explícitos
                $lineasTexto = explode("\n", $actividadTexto);
                $numLineasTotal = 0;

                // Calcular líneas considerando el ancho y los saltos de línea
                foreach ($lineasTexto as $linea) {
                    if (trim($linea) === '') {
                        $numLineasTotal += 1; // Línea vacía cuenta como 1
                    } else {
                        $anchoLinea = $pdf->GetStringWidth($linea);
                        $numLineasTotal += max(1, ceil($anchoLinea / $anchoActividad));
                    }
                }

                $alturaFila = max(8, $numLineasTotal * 4.5); // Mínimo 8mm, 4.5mm por línea

                // Verificar si hay espacio suficiente, si no, agregar nueva página
                if ($pdf->GetY() + $alturaFila > 250) { // 250mm es el límite antes del final de página
                    $pdf->AddPage();
                    $pdf->SetY(30); // Comenzar después del encabezado
                }

                // Guardar posición inicial
                $xInicio = 20;
                $yInicio = $pdf->GetY();

                // ACTIVIDAD (con MultiCell para texto largo) - Dibujar primero SIN BORDE
                $pdf->SetXY($xInicio + 25, $yInicio);
                $pdf->SetFont('Times', '', 10);
                $pdf->MultiCell(80, 4.5, $actividadTexto, 0, 'L');

                // Calcular altura real ocupada por ACTIVIDAD
                $yDespuesActividad = $pdf->GetY();
                $alturaActividadReal = $yDespuesActividad - $yInicio;

                // Usar la mayor altura entre actividad y cálculo previo (mínimo 10mm)
                $alturaFila = max(10, $alturaFila, $alturaActividadReal);

                // FECHA - con altura correcta
                $pdf->SetXY($xInicio, $yInicio);
                $pdf->SetFont('Times', 'B', 10);
                $pdf->Cell(25, $alturaFila, Carbon::parse($act['fecha'])->format('d/m/Y'), 1, 0, 'C');

                // ACTIVIDAD - Dibujar borde manualmente con altura correcta
                $pdf->Rect($xInicio + 25, $yInicio, 80, $alturaFila);

                // SUPERVISOR - calcular número de líneas
                $supervisorTexto = utf8_decode($supervisor);
                $anchoSupervisor = 45;
                $lineasSupervisor = explode("\n", $supervisorTexto);
                $numLineasSupervisor = count($lineasSupervisor);
                $alturaSupervisor = $numLineasSupervisor * 4;

                // Centrar verticalmente el supervisor
                $offsetSupervisor = ($alturaFila - $alturaSupervisor) / 2;

                $pdf->SetXY($xInicio + 105, $yInicio + $offsetSupervisor);
                $pdf->SetFont('Times', '', 10);
                $pdf->MultiCell(45, 4, $supervisorTexto, 0, 'C');

                // Dibujar el borde del SUPERVISOR manualmente
                $pdf->Rect($xInicio + 105, $yInicio, 45, $alturaFila);

                // OBS
                $pdf->SetXY($xInicio + 150, $yInicio);
                $pdf->Cell(25, $alturaFila, '', 1, 0, 'C');

                // Mover a la siguiente fila
                $pdf->SetXY($xInicio, $yInicio + $alturaFila);
            }
        }

        // CONCLUSIÓN - Verificar espacio antes de agregar
        if ($pdf->GetY() > 225) { // Si no hay espacio para conclusión
            $pdf->AddPage();
            $pdf->SetY(40);
        }

        $pdf->SetFont('Times', 'B', 12);
        $yPos = $pdf->GetY() + 5;
        $pdf->SetXY(20, $yPos);
        $pdf->Cell(10, 8, '3.', 0, 0, 'L');
        $pdf->Cell(165, 8, utf8_decode('CONCLUSIÓN'), 0, 1, 'L');

        $pdf->SetFont('Times', '', 11);
        $yPos = $pdf->GetY() + 3;
        $pdf->SetXY(20, $yPos);

        // Configurar MultiCell con control de página automático
        $pdf->SetAutoPageBreak(true, 30); // Margen inferior de 30mm para evitar la zona opaca

        $pdf->MultiCell(175, 5, utf8_decode($reporteactividad->conclusion), 0, 'J');

        // FIRMAS - Verificar espacio antes de agregar
        if ($pdf->GetY() > 220) { // Si no hay espacio para las firmas
            $pdf->AddPage();
            $pdf->SetY(30);
        }

        // Espacio antes de las firmas
        $yPosFirmas = $pdf->GetY() + 50;

        // Firma del Auxiliar/Pasante (Izquierda)
        $pdf->SetXY(30, $yPosFirmas);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(70, 5, '________________________', 0, 1, 'C');
        $pdf->SetXY(30, $yPosFirmas + 5);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(70, 5, utf8_decode($nombreCompleto), 0, 1, 'C');
        $pdf->SetXY(30, $yPosFirmas + 10);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(70, 5, utf8_decode('Asesor Comercial/Pasante'), 0, 1, 'C');

        // Firma del Director (Derecha)
        $pdf->SetXY(115, $yPosFirmas);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(70, 5, '________________________', 0, 1, 'C');
        $pdf->SetXY(115, $yPosFirmas + 5);
        $pdf->SetFont('Times', 'B', 10);
        $pdf->Cell(70, 5, utf8_decode(strtoupper($reporteactividad->admin)), 0, 1, 'C');
        $pdf->SetXY(115, $yPosFirmas + 10);
        $pdf->SetFont('Times', '', 10);
        $pdf->Cell(70, 5, utf8_decode('DIRECTOR/A DEL ÁREA DE ' . $nombreAreaLimpio), 0, 1, 'C');

        return $pdf->Output($outputMode); // Usar el modo de salida especificado
    }
}
