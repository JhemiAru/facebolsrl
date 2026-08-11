<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Certificado;
use Carbon\Carbon;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\Shared\Converter;

class GenerarCertificadoWordController extends Controller
{
    public function generarCertificadoHTML($id)
    {
        // Obtener el certificado por ID
        $certificado = Certificado::find($id);

        if (!$certificado) {
            return response()->json(['error' => "No se encontró el certificado con ID: $id"], 404);
        }

        // Formatear las fechas con Carbon
        $fechaCadena = $certificado->fecha_entrega;
        $fecha = Carbon::createFromFormat('Y-m-d', $fechaCadena)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

        $fechainicioCadena = $certificado->fecha_inicio;
        $fechainicio = Carbon::createFromFormat('Y-m-d', $fechainicioCadena)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

        $fechafinalCadena = $certificado->fecha_fin;
        $fechafinal = Carbon::createFromFormat('Y-m-d', $fechafinalCadena)->locale('es')->isoFormat('D [de] MMMM [de] YYYY');

        // Crear un nuevo documento Word
        $phpWord = new PhpWord();

        // Configurar el documento con tamaño carta y orientación vertical
        $section = $phpWord->addSection([
            'paperSize' => 'Letter',
            'orientation' => 'portrait',
            'marginTop' => 2500,
            'marginBottom' => 1000,
            'marginLeft' => 1200,
            'marginRight' => 1200,
        ]);

        // Agregar una imagen de fondo
        
        $section->addImage(public_path('vendor/adminlte/dist/img/CertificadoMembretado.png'), [
            'width' => 612, 
            'height' => 795, 
            'positioning' => 'absolute',
            'posHorizontal' => 'absolute',
            'posHorizontalRel' => 'page',
            'posVertical' => 'absolute',
            'posVerticalRel' => 'page',
            'marginTop' => Converter::inchToTwip(0), 
            'marginLeft' => Converter::inchToTwip(0), 
            'wrappingStyle'=> 'behind'
        ]);




        // Texto del certificado
        $section->addText(
            "La Paz, $fecha",
            ['size' => 12, 'name' => 'Times', 'bgColor' => null],
            ['alignment' => 'right']
        );

        $section->addTextBreak(1); // Espacio

        $section->addText(
            "CERTIFICADO DE ",
            ['bold' => true, 'size' => 30, 'name' => 'Times'],
            ['alignment' => 'center']
        );
        $section->addTextBreak(0.5); // Espacio

        $section->addText(
            "{$certificado->detalle->programa->programa}",
            ['bold' => true, 'size' => 30, 'name' => 'Times', 'bgColor' => null],
            ['alignment' => 'center']
        );

        $section->addTextBreak(1); // Espacio

        $section->addText(
            "FaceBol SRL, tiene a bien certificar, " .
            ($certificado->inscripcion->genero == 1 ? 'al Señor' : 'a la Señorita') .
            " {$certificado->inscripcion->informacion->nombre} {$certificado->inscripcion->informacion->apellido_paterno} " .
            "{$certificado->inscripcion->informacion->apellido_materno} con C.I. {$certificado->inscripcion->ci} " .
            "{$certificado->inscripcion->extension->expedido}. " .
            "Cumplió satisfactoriamente la etapa de {$certificado->detalle->programa->programa} en nuestra institución, " .
            "colaborando en el Área de {$certificado->detalle->area->nombre_area}. " .
            "{$certificado->detalle->descripcion}, durante {$certificado->meses} meses consecutivos, " .
            "del $fechainicio al $fechafinal, " .
            "acumulando una carga horaria de " . strtok($certificado->horas, ':') . " Horas {$certificado->tipo_horas}.",
            ['bold' => true,'size' => 12, 'name' => 'Times'],
            ['alignment' => 'center', 'lineHeight' => 1.5]
        );

        $section->addTextBreak(1); // Espacio

        $section->addText(
            "Durante este periodo, " .
            ($certificado->inscripcion->genero == 1 ? 'el Señor' : 'la Señorita') .
            " {$certificado->inscripcion->informacion->nombre} {$certificado->inscripcion->informacion->apellido_paterno} " .
            "demostró ser una persona responsable, puntual, honesta y dedicada en todas las labores que le fueron encomendadas.",
            ['lineHeight' => 1.5, 'bold' => true,'size' => 12, 'name' => 'Times']
        );

        $section->addTextBreak(1); // Espacio

        $section->addText(
            "A tal efecto se extiende el presente certificado para fines del interesado.",
            ['bold' => true,'size' => 12, 'name' => 'Times']
        );

        $section->addTextBreak(4); // Espacio

        $section->addText(
            "GERENTE GENERAL",
            ['bold' => true, 'size' => 12, 'name' => 'Times'],
            ['alignment' => 'center']
        );
        $section->addTextBreak(0.5);
        $section->addText(
            "LUIS FERNANDO ILAQUITA FERNANDEZ",
            ['bold' => true, 'size' => 12, 'name' => 'Times'],
            ['alignment' => 'center']
        );

        // Guardar el documento en un archivo temporal
        $fileName = "Certificado_$id.docx";
        $tempFile = storage_path("app/public/$fileName");
        $phpWord->save($tempFile, 'Word2007');

        // Retornar el archivo como respuesta
        return response()->download($tempFile)->deleteFileAfterSend(true);
    }
}
