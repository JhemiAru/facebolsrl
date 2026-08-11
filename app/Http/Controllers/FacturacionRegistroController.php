<?php

namespace App\Http\Controllers;

use App\Models\Facturacion;
use App\Models\FacturacionRegistro;
use App\Models\Informacion;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class FacturacionRegistroController extends Controller
{
    public function index(Request $request)
    {
        $query = Facturacion::select('id', 'id_informacion', 'ci_nit', 'estado', 'tipo', 'anulado')
            ->with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'registro:id,id_facturacion,n_registro,fecha,concepto,monto,monto_literal'
            ])
            ->where('tipo', 'registro')
            ->whereHas('registro')
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

        // Obtener el siguiente número basado en el último n_registro existente
        $ultimoRegistro = FacturacionRegistro::orderBy('n_registro', 'desc')->first();
        if ($ultimoRegistro) {
            $ultimoNumero = intval($ultimoRegistro->n_registro);
            $siguienteNumero = str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
        } else {
            $siguienteNumero = '000001';
        }

        return view('facturaciones.registro.index', compact('facturas', 'clientes', 'siguienteNumero'));
    }

    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(), [
                'fecha' => 'required|date',
                'id_informacion' => 'required|exists:informacions,id',
                'ci_nit' => 'nullable|string|max:50',
                'concepto' => 'required|string|max:500',
                'estado' => 'required|string|in:no_cancelado,pago_efectivo,pago_deposito,pago_horas',
                'monto' => 'required|numeric|min:0',
                'monto_literal' => 'nullable|string|max:255',
            ], [
                'fecha.required' => 'La fecha es obligatoria',
                'id_informacion.required' => 'Debe seleccionar un cliente',
                'id_informacion.exists' => 'El cliente seleccionado no existe',
                'concepto.required' => 'El concepto es obligatorio',
                'estado.required' => 'El estado de pago es obligatorio',
                'monto.required' => 'El monto es obligatorio',
                'monto.numeric' => 'El monto debe ser un número válido',
                'monto.min' => 'El monto debe ser mayor o igual a 0',
            ]);

            if ($validator->fails()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Por favor corrija los errores en el formulario',
                        'errors' => $validator->errors()
                    ], 422);
                }
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            // Crear la facturación principal
            $facturacion = Facturacion::create([
                'id_informacion' => $request->id_informacion,
                'ci_nit' => $request->ci_nit,
                'estado' => $request->estado,
                'tipo' => 'registro',
                'anulado' => false
            ]);

            // Obtener el ID que se acaba de crear
            $idFacturacion = $facturacion->id;

            // Generar el número de registro basado en el último n_registro existente
            $ultimoRegistro = FacturacionRegistro::orderBy('n_registro', 'desc')->first();
            if ($ultimoRegistro) {
                $ultimoNumero = intval($ultimoRegistro->n_registro);
                $numeroRegistro = str_pad($ultimoNumero + 1, 6, '0', STR_PAD_LEFT);
            } else {
                $numeroRegistro = '000001';
            }

            // Crear el registro en facturaciones_registros
            FacturacionRegistro::create([
                'id_facturacion' => $idFacturacion,
                'n_registro' => $numeroRegistro,
                'fecha' => $request->fecha,
                'concepto' => $request->concepto,
                'monto' => $request->monto,
                'monto_literal' => $request->monto_literal
            ]);

            if ($request->ajax() || $request->wantsJson()) {
                cache()->forget('clientes_facturacion');

                return response()->json([
                    'success' => true,
                    'message' => 'Factura registrada correctamente con el N° ' . $numeroRegistro
                ]);
            }

            return redirect()->route('facturacion.comprobante.index')
                ->with('mensaje', 'Registro de facturación creado exitosamente: ' . $numeroRegistro);
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo guardar la factura. Por favor, intente nuevamente.'
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al crear el registro');
        }
    }

    /**
     * Obtener un registro específico (para modales ver/editar)
     */
    public function show($id)
    {
        try {
            $factura = Facturacion::with([
                'informacion:id,nombre,apellido_paterno,apellido_materno',
                'registro:id,id_facturacion,n_registro,fecha,concepto,monto,monto_literal'
            ])->findOrFail($id);

            return response()->json([
                'success' => true,
                'factura' => $factura
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => 'Error al cargar el registro: ' . $e->getMessage()
            ], 500);
        }
    }

    public function update(Request $request, $id)
    {
        try {
            // Validar todos los campos
            $validator = Validator::make($request->all(), [
                'fecha' => 'required|date',
                'id_informacion' => 'required|exists:informacions,id',
                'ci_nit' => 'nullable|string|max:50',
                'concepto' => 'required|string|max:500',
                'estado' => 'required|string|in:no_cancelado,pago_efectivo,pago_deposito,pago_horas',
                'monto' => 'required|numeric|min:0',
                'monto_literal' => 'nullable|string|max:255',
                'anulado' => 'nullable|boolean',
            ], [
                'fecha.required' => 'La fecha es obligatoria',
                'id_informacion.required' => 'Debe seleccionar un cliente',
                'id_informacion.exists' => 'El cliente seleccionado no existe',
                'concepto.required' => 'El concepto es obligatorio',
                'estado.required' => 'El estado de pago es obligatorio',
                'monto.required' => 'El monto es obligatorio',
                'monto.numeric' => 'El monto debe ser un número válido',
                'monto.min' => 'El monto debe ser mayor o igual a 0',
            ]);

            if ($validator->fails()) {
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Por favor corrija los errores en el formulario',
                        'errors' => $validator->errors()
                    ], 422);
                }
                return redirect()->back()
                    ->withErrors($validator)
                    ->withInput();
            }

            $facturacion = Facturacion::with('registro')->findOrFail($id);

            // Actualizar facturación principal
            $facturacion->update([
                'id_informacion' => $request->id_informacion,
                'ci_nit' => $request->ci_nit,
                'estado' => $request->estado,
                'anulado' => $request->has('anulado') ? true : false
            ]);

            // Actualizar registro relacionado
            if ($facturacion->registro) {
                $facturacion->registro->update([
                    'fecha' => $request->fecha,
                    'concepto' => $request->concepto,
                    'monto' => $request->monto,
                    'monto_literal' => $request->monto_literal
                ]);
            }

            // Limpiar caché
            cache()->forget('clientes_facturacion');

            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => true,
                    'message' => '✅ Factura actualizada correctamente'
                ]);
            }

            return redirect()->route('facturacion.comprobante.index')
                ->with('mensaje', '✅ Factura actualizada correctamente');
        } catch (\Exception $e) {
            if ($request->ajax() || $request->wantsJson()) {
                return response()->json([
                    'success' => false,
                    'message' => 'No se pudo actualizar la factura. Por favor, intente nuevamente.'
                ], 500);
            }

            return redirect()->back()
                ->withInput()
                ->with('error', 'Error al actualizar el registro');
        }
    }

    public function destroy($id)
    {
        try {
            // Buscar la facturación
            $facturacion = Facturacion::findOrFail($id);

            // Eliminar primero el registro relacionado si existe
            if ($facturacion->registro) {
                $facturacion->registro->delete();
            }

            // Eliminar la facturación
            $facturacion->delete();

            return redirect()->route('facturacion.comprobante.index')
                ->with('mensaje', '✅ Comprobante eliminado exitosamente');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al eliminar el registro: ' . $e->getMessage());
        }
    }

    public function pdfFactura($id)
    {
        try {
            $factura = Facturacion::with(['informacion', 'registro'])->findOrFail($id);

            // Verificar que sea un registro
            if ($factura->tipo !== 'registro') {
                return redirect()->back()
                    ->with('error', 'Esta facturación no es un registro.');
            }

            // Formatear estado
            $factura->estado = $factura->estado === 'no_cancelado' ? 'No Cancelado' : ($factura->estado === 'pago_efectivo' ? 'Pago en Efectivo' : ($factura->estado === 'pago_deposito' ? 'Pago por Depósito' : 'Pago en Horas'));
            $factura->estado = strtoupper($factura->estado);

            // Convertir nombre completo del cliente a mayúsculas
            if ($factura->informacion) {
                $factura->informacion->nombre = strtoupper($factura->informacion->nombre);
                $factura->informacion->apellido_paterno = strtoupper($factura->informacion->apellido_paterno);
                $factura->informacion->apellido_materno = strtoupper($factura->informacion->apellido_materno);
            }

            // Convertir monto literal a mayúsculas
            if ($factura->registro->monto_literal) {
                $factura->registro->monto_literal = strtoupper($factura->registro->monto_literal);
            }

            // Convertir concepto a mayúsculas
            $factura->registro->concepto = strtoupper($factura->registro->concepto);

            // Obtener el número de registro
            $numeroRegistro = $factura->registro ? $factura->registro->n_registro : 'N/A';

            $pdf = Pdf::loadView('facturaciones.registro.pdf', compact('factura'))
                ->setPaper([0, 0, 612, 396], 'portrait');

            return $pdf->stream('Registro_' . $numeroRegistro . '.pdf');
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }

    public function pdfTodas(Request $request)
    {
        try {
            $query = Facturacion::with(['informacion', 'registro'])
                ->where('tipo', 'registro');

            // Filtrar por cliente si se proporciona el parámetro
            if ($request->has('cliente') && $request->cliente != '') {
                $nombreCliente = strtolower($request->cliente);
                $query->whereHas('informacion', function ($q) use ($nombreCliente) {
                    $q->whereRaw('LOWER(CONCAT(nombre, " ", apellido_paterno, " ", apellido_materno)) LIKE ?', ["%{$nombreCliente}%"]);
                });
            }

            $facturas = $query->orderBy('id', 'desc')
                ->get();

            if ($facturas->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'No hay registros para generar el PDF');
            }

            // Procesar cada factura
            foreach ($facturas as $factura) {
                $factura->estado = $factura->estado === 'no_cancelado' ? 'No Cancelado' : ($factura->estado === 'pago_efectivo' ? 'Pago en Efectivo' : ($factura->estado === 'pago_deposito' ? 'Pago por Depósito' : 'Pago en Horas'));
                $factura->estado = strtoupper($factura->estado);

                // Convertir nombre completo del cliente a mayúsculas
                if ($factura->informacion) {
                    $factura->informacion->nombre = strtoupper($factura->informacion->nombre);
                    $factura->informacion->apellido_paterno = strtoupper($factura->informacion->apellido_paterno);
                    $factura->informacion->apellido_materno = strtoupper($factura->informacion->apellido_materno);
                }

                // Convertir monto literal a mayúsculas
                if ($factura->registro->monto_literal) {
                    $factura->registro->monto_literal = strtoupper($factura->registro->monto_literal);
                }

                // Convertir concepto a mayúsculas
                $factura->registro->concepto = strtoupper($factura->registro->concepto);
            }

            $pdf = Pdf::loadView('facturaciones.registro.pdf-todas', compact('facturas'))
                ->setPaper([0, 0, 612, 396], 'portrait');

            // Nombre del archivo según si está filtrado o no
            if ($request->has('cliente') && $request->cliente != '') {
                // Obtener el primer cliente para el nombre del archivo
                $primerCliente = $facturas->first();
                if ($primerCliente && $primerCliente->informacion) {
                    $nombreArchivo = 'Registros_' .
                        $primerCliente->informacion->nombre . '_' .
                        $primerCliente->informacion->apellido_paterno . '_' .
                        date('Y-m-d') . '.pdf';
                } else {
                    $nombreArchivo = 'Registros_Filtrados_' . date('Y-m-d') . '.pdf';
                }
            } else {
                $nombreArchivo = 'Todos_Registros_' . date('Y-m-d') . '.pdf';
            }

            return $pdf->stream($nombreArchivo);
        } catch (\Exception $e) {
            return redirect()->back()
                ->with('error', 'Error al generar el PDF: ' . $e->getMessage());
        }
    }
}
