<?php

namespace App\Http\Controllers;

use App\Models\Facturacion;
use App\Models\FacturacionRecibo;
use App\Models\Informacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FacturacionReciboController extends Controller
{
    public function index(Request $request)
    {
        $query = Facturacion::select('id', 'id_informacion', 'ci_nit', 'estado', 'tipo', 'anulado')
            ->with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'recibo:id,id_facturacion,n_recibo,fecha_recibo,monto_total,monto_literal',
                'recibo.conceptos:id,id_recibo,concepto,fecha_concepto,monto,orden'
            ])
            ->where('tipo', 'recibo')
            ->whereHas('recibo')
            ->orderBy('id', 'desc');

        // Filtrar por cliente si se proporciona el parámetro
        if ($request->has('cliente') && $request->cliente != '') {
            $query->where('id_informacion', $request->cliente);
        }

        // Paginación optimizada
        $facturas = $query->paginate(10)->appends($request->except('page'));

        // Caché de clientes para evitar consulta repetitiva (se cachea por 1 hora)
        $clientes = cache()->remember('clientes_facturacion', 3600, function () {
            return Informacion::select('id', 'nombre', 'apellido_paterno', 'apellido_materno')
                ->orderBy('nombre')
                ->get();
        });

        // Obtener el siguiente número basado en el último n_recibo existente
        $ultimoRecibo = FacturacionRecibo::orderBy('n_recibo', 'desc')->first();
        if ($ultimoRecibo) {
            $ultimoNumero = intval($ultimoRecibo->n_recibo);
            $siguienteNumero = str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $siguienteNumero = '000001';
        }

        return view('facturaciones.recibo.index', compact('facturas', 'clientes', 'siguienteNumero'));
    }

    public function store(Request $request)
    {
        try {
            $request->validate([
                'id_informacion' => 'required|exists:informacions,id',
                'ci_nit' => 'nullable|string|max:50',
                'estado' => 'required|string|in:pago_efectivo,pago_deposito',
                'fecha_recibo' => 'required|date',
                'monto_literal' => 'nullable|string|max:255',
                'conceptos' => 'required|array|min:1',
                'conceptos.*.concepto' => 'required|string|max:500',
                'conceptos.*.fecha_concepto' => 'required|date',
                'conceptos.*.monto' => 'required|numeric|min:0',
            ]);

            // Calcular el monto total desde los conceptos
            $montoTotal = collect($request->conceptos)->sum('monto');

            // Crear la facturación principal
            $facturacion = Facturacion::create([
                'id_informacion' => $request->id_informacion,
                'ci_nit' => $request->ci_nit,
                'estado' => $request->estado,
                'tipo' => 'recibo',
                'anulado' => false
            ]);

            // Generar el número de recibo basado en el último n_recibo existente
            $ultimoRecibo = FacturacionRecibo::orderBy('n_recibo', 'desc')->first();
            if ($ultimoRecibo) {
                $ultimoNumero = intval($ultimoRecibo->n_recibo);
                $numeroRecibo = str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $numeroRecibo = '000001';
            }

            // Crear el recibo en facturaciones_recibos
            $recibo = FacturacionRecibo::create([
                'id_facturacion' => $facturacion->id,
                'n_recibo' => $numeroRecibo,
                'fecha_recibo' => $request->fecha_recibo,
                'monto_total' => $montoTotal,
                'monto_literal' => $request->monto_literal
            ]);

            // Crear los conceptos
            foreach ($request->conceptos as $index => $conceptoData) {
                \App\Models\ReciboConcepto::create([
                    'id_recibo' => $recibo->id,
                    'concepto' => $conceptoData['concepto'],
                    'fecha_concepto' => $conceptoData['fecha_concepto'],
                    'monto' => $conceptoData['monto'],
                    'orden' => $index + 1
                ]);
            }

            // Si es una petición
            if ($request->ajax() || $request->wantsJson()) {
                // Limpiar caché si se creó desde un nuevo cliente
                cache()->forget('clientes_facturacion');

                return response()->json([
                    'success' => true,
                    'message' => 'Recibo de facturación creado exitosamente: ' . $numeroRecibo
                ]);
            }

            return redirect()->route('facturacion.recibo.index')
                ->with('success', '✅ Recibo de facturación creado exitosamente: ' . $numeroRecibo);
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si es una petición AJAX, devolver JSON con errores
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Por favor, corrija los errores en el formulario',
                    'errors' => $e->validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Por favor, corrija los errores en el formulario');
        } catch (\Exception $e) {
            // Si es una petición AJAX, devolver JSON con error
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al crear el recibo: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el recibo: ' . $e->getMessage());
        }
    }

    /**
     * Obtener un recibo específico con sus conceptos (para modales ver/editar)
     */
    public function show($id)
    {
        try {
            $factura = Facturacion::with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'recibo:id,id_facturacion,n_recibo,fecha_recibo,monto_total,monto_literal',
                'recibo.conceptos:id,id_recibo,concepto,fecha_concepto,monto,orden'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'factura' => $factura
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar el recibo: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Solo validar el campo anulado
            $request->validate([
                'anulado' => 'nullable|boolean',
            ]);

            $facturacion = Facturacion::findOrFail($id);

            // Actualizar solo el estado de anulado en la facturación
            $facturacion->update([
                'anulado' => $request->has('anulado') ? true : false
            ]);

            // Si es una petición AJAX, devolver JSON
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '✅ Estado del recibo actualizado correctamente'
                ]);
            }

            return redirect()->route('facturacion.recibo.index')
                ->with('mensaje', '✅ Estado del recibo actualizado correctamente');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Si es una petición AJAX, devolver JSON con errores
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Por favor, corrija los errores en el formulario',
                    'errors' => $e->validator->errors()
                ], 422);
            }

            return redirect()->back()
                ->withErrors($e->validator)
                ->withInput()
                ->with('error', 'Por favor, corrija los errores en el formulario');
        } catch (\Exception $e) {
            // Si es una petición AJAX, devolver JSON con error
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'Error al actualizar el recibo: ' . $e->getMessage()
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el recibo: ' . $e->getMessage());
        }
    }

    public function destroy($id)
    {
        try {
            // Buscar la facturación
            $facturacion = Facturacion::findOrFail($id);

            // Eliminar primero el recibo relacionado si existe
            if ($facturacion->recibo) {
                $facturacion->recibo->delete();
            }

            // Eliminar la facturación
            $facturacion->delete();

            return redirect()->route('facturacion.recibo.index')
                ->with('mensaje', '✅ Recibo eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el recibo: ' . $e->getMessage());
        }
    }

    public function pdfFactura($id)
    {
        try {
            $factura = Facturacion::with(['informacion', 'recibo.conceptos'])->findOrFail($id);

            if ($factura->tipo !== 'recibo') {
                return redirect()->back()
                    ->with('error', 'Esta facturación no es un recibo.');
            }

            $numeroRecibo = $factura->recibo ? $factura->recibo->n_recibo : 'N/A';

            $pdf = Pdf::loadView('facturaciones.recibo.pdf', compact('factura'))
                ->setPaper([0, 0, 396, 360], 'portrait');

            return $pdf->stream('Recibo_' . $numeroRecibo . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    public function pdfTodas()
    {
        try {
            $facturas = Facturacion::with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'recibo.conceptos'
            ])
                ->where('tipo', 'recibo')
                ->whereHas('recibo')
                ->orderBy('id', 'desc')
                ->get();

            if ($facturas->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'No hay recibos para generar el PDF');
            }

            $pdf = Pdf::loadView('facturaciones.recibo.pdf-todas', compact('facturas'))
                ->setPaper([0, 0, 396, 360], 'portrait');

            return $pdf->stream('Todos_Recibos_' . date('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    public function pdfCliente($clienteId)
    {
        try {
            $facturas = Facturacion::with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'recibo.conceptos'
            ])
                ->where('tipo', 'recibo')
                ->where('id_informacion', $clienteId)
                ->whereHas('recibo')
                ->orderBy('id', 'desc')
                ->get();

            if ($facturas->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'No hay recibos para este cliente');
            }

            $primeraFactura = $facturas->first();
            $clienteNombre = 'Cliente';

            if ($primeraFactura->informacion) {
                $nombre = $primeraFactura->informacion->nombre ?? '';
                $apellido = $primeraFactura->informacion->apellido_paterno ?? '';
                $clienteNombre = trim($nombre . ' ' . $apellido);
                $clienteNombre = !empty($clienteNombre) ? str_replace(' ', '_', $clienteNombre) : 'Cliente';
            }

            $pdf = Pdf::loadView('facturaciones.recibo.pdf-todas', compact('facturas'))
                ->setPaper([0, 0, 396, 360], 'portrait');

            return $pdf->stream('Recibos_' . $clienteNombre . '_' . date('Y-m-d') . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    /**
     * Mostrar solo los recibos del usuario autenticado (para pasantes)
     * Consulta optimizada para alto rendimiento con miles de registros
     * Relación: User → Inscripcion (via codigo_credencial) → Informacion (via id_informacion)
     */
    public function misRecibos(Request $request)
    {
        // Obtener el usuario autenticado
        $user = Auth::user();

        // Buscar la inscripción del usuario usando codigo_credencial
        $inscripcion = \App\Models\Inscripcion::where('codigo_credencial', $user->codigo_credencial)->first();

        // Si no existe inscripción, mostrar mensaje
        if (!$inscripcion) {
            $facturas = new \Illuminate\Pagination\LengthAwarePaginator(
                [],
                0,
                10,
                1,
                ['path' => $request->url(), 'query' => $request->query()]
            );
            return view('facturaciones.recibo.mis-recibos', [
                'facturas' => $facturas,
                'mensaje' => 'No se encontró inscripción asociada a tu usuario. Por favor contacta al administrador.'
            ]);
        }

        // Obtener el id_informacion de la inscripción
        $idInformacion = $inscripcion->id_informacion;

        // Consulta ultra optimizada: solo campos necesarios, sin cargar conceptos
        $query = Facturacion::select('id', 'id_informacion', 'ci_nit', 'estado', 'tipo', 'anulado')
            ->with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'recibo:id,id_facturacion,n_recibo,fecha_recibo,monto_total,monto_literal',
                'recibo.conceptos:id,id_recibo,concepto,fecha_concepto,monto,orden'
            ])
            ->where('tipo', 'recibo')
            ->where('id_informacion', $idInformacion)  // Filtrar por el id_informacion de la inscripción
            ->whereHas('recibo')
            ->orderBy('id', 'desc');

        // Paginación optimizada
        $facturas = $query->paginate(10)->appends($request->except('page'));

        return view('facturaciones.recibo.mis-recibos', compact('facturas'));
    }

    public function enviarCorreo(Request $request, $id)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'mensaje' => 'nullable|string'
            ]);

            $factura = Facturacion::with(['informacion', 'recibo.conceptos'])->findOrFail($id);

            if ($factura->tipo !== 'recibo') {
                return response()->json([
                    'success' => false,
                    'message' => 'Esta facturación no es un recibo.'
                ], 400);
            }

            // Obtener todos los recibos del cliente
            $facturas = Facturacion::with(['informacion', 'recibo.conceptos'])
                ->where('tipo', 'recibo')
                ->where('id_informacion', $factura->id_informacion)
                ->whereHas('recibo')
                ->orderBy('id', 'desc')
                ->get();

            $logoPath = public_path('vendor/adminlte/dist/img/facebolLogo.png');
            $watermarkPath = public_path('vendor/adminlte/dist/img/facebolLogo.png');

            if (!file_exists($logoPath)) {
            \Log::warning('Logo no encontrado en: ' . $logoPath);
            }
            
            // Crear directorio temporal si no existe
            $tempDir = storage_path('app/temp');
            if (!file_exists($tempDir)) {
                mkdir($tempDir, 0755, true);
            }

            // Generar el PDF usando pdf-enviar
            $pdf = Pdf::loadView('facturaciones.recibo.pdf-enviar', compact('facturas', 'logoPath', 'watermarkPath'))
                ->setPaper([0, 0, 396, 612], 'portrait')
                ->setOptions([
                'defaultFont' => 'sans-serif',
                'isRemoteEnabled' => true,
                'isHtml5ParserEnabled' => true,
                'isPhpEnabled' => true
            ]);

            // Guardar el PDF temporalmente
            $pdfFileName = 'recibo_' . $factura->id . '_' . time() . '.pdf';
            $pdfPath = storage_path('app/temp/' . $pdfFileName);
            //$pdfPath = storage_path('app/temp/recibo_' . $factura->id . '_' . time() . '.pdf');

            $pdf->save($pdfPath);

            // Verificar que el PDF se creó correctamente
            if (!file_exists($pdfPath) || filesize($pdfPath) === 0) {
            throw new \Exception('No se pudo generar el PDF correctamente');
            }

            // Pequeño delay para evitar que Gmail marque como spam
            usleep(500000); // 0.5 segundos

            // Enviar el correo
            $mensajeExtra = $request->input('mensaje', '');
            $numeroRecibo = $factura->recibo->n_recibo ?? 'N/A';
            $email = $request->email;

            // Configurar el correo
            //\Illuminate\Support\Facades\Mail::to($request->email)
            //    ->send(new \App\Mail\ReciboMail($factura, $pdfPath, $mensajeExtra, $numeroRecibo));

            \Illuminate\Support\Facades\Mail::send(
            new \App\Mail\ReciboMail($factura, $pdfPath, $mensajeExtra, $numeroRecibo, $email));
            // Pequeño delay antes de eliminar el archivo
            usleep(500000); // 0.5 segundos

            // Eliminar el archivo temporal
            if (file_exists($pdfPath)) {
                unlink($pdfPath);
            }

            return response()->json([
                'success' => true,
                'message' => 'Correo enviado exitosamente a '. $email
            ]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json([
                'success' => false,
                'message' => 'El correo electrónico no es válido'
            ], 422);
        } catch (\Exception $e) {
                 \Log::error('Error al enviar correo: ' . $e->getMessage());
                \Log::error($e->getTraceAsString());
            return response()->json([
            'success' => false,
            'message' => 'Error al enviar el correo: ' . $e->getMessage()
            ], 500);
        }
    }
}
