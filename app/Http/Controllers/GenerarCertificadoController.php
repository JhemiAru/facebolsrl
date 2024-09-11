<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Codedge\Fpdf\Fpdf\Fpdf;
use App\Models\Certificado;
use App\Models\Detalle;
use Carbon\Carbon;

class GenerarCertificadoController extends Controller
{

    public function generarcertificado($id)
    {
        // Obtener los certificados del usuario con el $id especificado
        $certificados = Certificado::where('id', $id)->get();
       /*  dd($certificados); */
        // Verificar si la colección de certificados está vacía
        if ($certificados->isEmpty()) {
            // Manejar caso de no encontrar certificados
            return "No se encontraron certificados para el usuario con ID: $id";
        }

        foreach ($certificados as $certificado) {
            // Asegurarse de que $certificado sea un objeto válido antes de usarlo
            if (!is_object($certificado)) {
                continue; // Saltar este certificado si no es un objeto válido
            }

            // Crear una nueva instancia de FPDF para cada certificado
            $pdf = new Fpdf('P', 'mm', 'letter');
            $pdf->AddPage();
            $pdf->Image('vendor/adminlte/dist/img/fondo.jpeg', 0, 0, 215, 280, 'JPEG');
            $pdf->Image('vendor/adminlte/dist/img/membretadofacebol1.png', 15, 15, 65, 25, 'PNG');
            $pdf->SetFont('Times', '', 12);

            // Formatear fechas utilizando Carbon
            $fechaCadena = $certificado->fecha_entrega;
            $fecha = Carbon::createFromFormat('Y-m-d', $fechaCadena)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

            $fechainicioCadena = $certificado->fecha_inicio;
            $fechainicio = Carbon::createFromFormat('Y-m-d', $fechainicioCadena)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

            $fechafinalCadena = $certificado->fecha_fin;
            $fechafinal = Carbon::createFromFormat('Y-m-d', $fechafinalCadena)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

            // Agregar contenido al PDF
            $pdf->Cell(180, 35, 'La Paz, ' . $fecha, 0, 0, 'R');
            $pdf->setXY(35, 50);
            $pdf->SetFont('Times', 'B', 25);
            $pdf->MultiCell(150, 9, utf8_decode('CERTIFICADO DE ' . $certificado->detalle->programa->programa), 0, 'C');

            // Lógica para determinar el género
            if ($certificado->hora) {
                $genero = 'al Señor';
            } else {
                $genero = 'a la Señorita';
            }

            if ($certificado->inscripcion->genero == 1) {
                $genero='al Señor';
                $pdf->SetFont('Times', 'B', 12);
                $genero_negrilla = $genero;
                $genero1='el Señor';
                $pdf->SetFont('Times', 'B', 12);
            }else{
                $genero='a la Señorita';
                $pdf->SetFont('Times', 'B', 12);
                $genero_negrilla = $genero;
                $genero1='la Señorita';
                $pdf->SetFont('Times', 'B', 12);

            }

            $deta = $certificado->detalle->descripcion;

            $pdf->setXY(20, 75);
            $pdf->SetFont('Times', 'B', 12);
            $pdf->MultiCell(170, 8, utf8_decode('   FaceBol SRL, tiene a bien certificar, ' . $genero . ': ' . $certificado->inscripcion->informacion->nombre_apellido . ' con C.I. ' . $certificado->inscripcion->ci . ' ' . $certificado->inscripcion->extension->expedido . '. Cumplió satisfactoriamente la etapa de ' . $certificado->detalle->programa->programa . ' en nuestra institución, colaborando en el Área de ' . $certificado->detalle->area->nombre_area . '. ' . $deta . ', durante ' . $certificado->meses . ' meses consecutivos, del ' . $fechainicio . ' al ' . $fechafinal . ',  acumulando una carga horaria de ' . \Illuminate\Support\Str::before($certificado->horas, ':') . ' Horas ' . $certificado->tipo_horas . '.'), 0, 'J');
            $pdf->ln(5);
            $pdf->setX(20);
            $pdf->MultiCell(170, 8, utf8_decode('   Durante este periodo, ' . $genero1 . ': ' . $certificado->inscripcion->informacion->nombre_apellido . ' demostró ser una persona responsable, puntual, honesta, eficiente y dedicado en todas las labores que le fueron encomendadas.'), 0, 'J');
            $pdf->ln(5);
            $pdf->setX(20);
            $pdf->MultiCell(170, 8, utf8_decode('   A tal efecto se extiende el presente certificado para fines del interesado.'), 0, 'J');

            $pdf->ln(90);
            $pdf->setX(20);
            $pdf->MultiCell(170, 5, utf8_decode('GERENTE GENERAL
            LUIS FERNANDO ILAQUITA FERNANDEZ'), 0, 'C');

            // Salida del PDF para este certificado específico
            $pdf->Output();
        }
    }
}
