<?php
namespace App\Http\Controllers;

use App\Models\Inventario;
use App\Models\Facturacion;
use App\Models\Informacion;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\Log;

class InventarioController extends Controller 
{
    /**
     * Listado de inventarios
     */
    public function index(Request $request)
    {
        $query = Inventario::select('id', 'id_facturacion','n_inventario','fecha_inve','cantidad', 'concepto','precio_uni','sub_total', 'total','tipo','anulado')
    ->with([
    'facturacion:id,id_informacion,ci_nit,estado',
    'facturacion.informacion:id,nombre,apellido_paterno,apellido_materno'
    ])
    ->whereHas('facturacion')
    ->orderBy('id', 'desc');


        // Filtro por facturación
        if ($request->filled('id_facturacion')) {
            $query->where('id_facturacion', $request->id_facturacion);
        }

        $inventarios = $query->paginate(10)->appends($request->except('page'));
        

        // Generar siguiente número de inventario
        $ultimo = Inventario::orderBy('n_inventario', 'desc')->first();
        $siguienteNumero = $ultimo
            ? str_pad(intval($ultimo->n_inventario) + 1, 6, '0', STR_PAD_LEFT)
            : '000001';

         $clientes = Informacion::orderBy('nombre')->get();
        // Obtener lista de facturaciones para el select
        $facturas = Facturacion::all();

        return view('inventario.index', compact('inventarios', 'siguienteNumero', 'facturas', 'clientes'));
    }

    /**
     * Guardar inventario
     */
    public function store(Request $request)
    {
                $request->validate([
            'id_informacion' => 'required|exists:informacions,id',
            'ci_nit' => 'nullable|string|max:50',
            'fecha_inve' => 'required|date',
            'tipo' => 'required|in:compra,venta,bono',
            'conceptos' => 'required|array|min:1',
            'conceptos.*.concepto' => 'required|string|max:500',
            /* 'conceptos.*.fecha_concepto' => 'required|date', */
            'conceptos.*.precio_uni' => 'required|numeric|min:0',
            'conceptos.*.cantidad' => 'required|numeric|min:0',
        ]);

        $facturacion = Facturacion::create([
            'id_informacion' => $request->id_informacion,
            'ci_nit' => $request->ci_nit,
            'tipo' => 'recibo',
            'anulado' => false
        ]);

        $ultimo = Inventario::orderBy('n_inventario', 'desc')->first();
        $numeroInventario = $ultimo
            ? str_pad(intval($ultimo->n_inventario) + 1, 6, '0', STR_PAD_LEFT)
            : '000001';

        $conceptos = $request->input('conceptos');

            $totalGeneral = 0;
            $cantidadTotal = 0;

         $conceptosParaGuardar = [];

        foreach ($request->input('conceptos') as $item) {
            $cantidad = isset($item['cantidad']) ? (int)$item['cantidad'] : 1;
            $precioUni = isset($item['precio_uni']) ? (float)$item['precio_uni'] : 0;
            $subTotal = $cantidad * $precioUni;

            $conceptosParaGuardar[] = [
                'concepto' => $item['concepto'] ?? $item['CONCEPTO'] ?? '',
                'cantidad' => $cantidad,
                'precio_uni' => $precioUni,
                'sub_total' => $subTotal
            ];
        }

        Inventario::create([
            'id_facturacion' => $facturacion->id,
            'n_inventario' => $numeroInventario,
            'fecha_inve' => $request->fecha_inve,
            'cantidad' => array_sum(array_column($conceptosParaGuardar, 'cantidad')),
            'concepto' => json_encode($conceptosParaGuardar),
            'precio_uni' => 0,
            'sub_total' => array_sum(array_column($conceptosParaGuardar, 'sub_total')),
            'total' => array_sum(array_column($conceptosParaGuardar, 'sub_total')),
            'tipo' => $request->tipo,
        ]);


            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Inventario registrado correctamente'
                ]);
            }

            return redirect()->route('inventario.index')
                ->with('success', 'Inventario registrado correctamente');
    }

    /**
     * Mostrar inventario (modal ver / editar)
     */
    public function show($id)
    {
            $inventario = Inventario::with(
                'facturacion:id,id_informacion,ci_nit,estado',
                'facturacion.informacion:id,nombre,apellido_paterno,apellido_materno'
                
            )->findOrFail($id);

            return response()->json([
                'success' => true,
                'inventario' => $inventario
            ]);
    }

    /**
     * Actualizar inventario
     */
    public function update(Request $request, $id)
    {
              $inventario = Inventario::findOrFail($id);

            if ($request->has('anulado') && !$request->has('conceptos')) {
                $inventario->update([
                    'anulado' => $request->anulado
                ]);

                return response()->json([
                    'success' => true,
                    'message' => 'Estado actualizado correctamente'
                ]);
            }

            $request->validate([
                'fecha_inve' => 'required|date',
                'conceptos' => 'required|array|min:1',
                'conceptos.*.concepto' => 'required|string|max:500',
                'conceptos.*.cantidad' => 'required|integer|min:1',
                'conceptos.*.precio_uni' => 'required|numeric|min:0',
            ]);

            $conceptosParaGuardar = [];
            $total = 0;
            $cantidadTotal = 0;

            foreach ($request->conceptos as $item) {
                $cantidad = (int)$item['cantidad'];
                $precio = (float)$item['precio_uni'];
                $subTotal = $cantidad * $precio;

                $cantidadTotal += $cantidad;
                $total += $subTotal;

                $conceptosParaGuardar[] = [
                    'concepto' => $item['concepto'],
                    'cantidad' => $cantidad,
                    'precio_uni' => $precio,
                    'sub_total' => $subTotal,
                ];
            }

            $inventario->update([
                'fecha_inve' => $request->fecha_inve,
                'cantidad' => $cantidadTotal,
                'concepto' => json_encode($conceptosParaGuardar),
                'precio_uni' => 0,
                'sub_total' => $total,
                'total' => $total,
                'anulado' => false
            ]);

            if ($request->ajax()) {
                return response()->json([
                    'success' => true,
                    'message' => 'Inventario actualizado'
                ]);
            }

            return redirect()->route('inventarios.index')
                ->with('success', 'Inventario actualizado correctamente');
    }

    /**
     * Eliminar inventario
     */
    public function destroy($id)
    {
            Inventario::findOrFail($id)->delete();

            return redirect()->route('inventarios.index')
                ->with('success', 'Inventario eliminado correctamente');
    }

    /**
     * Generar PDF individual de un inventario
     */
    public function pdfInventario($id)
    {
            $inventario = Inventario::findOrFail($id);
             $conceptos = json_decode($inventario->concepto, true); 
            
            $pdf = Pdf::loadView('inventario.pdf', compact('inventario'))
                ->setPaper([0, 0, 396, 360], 'portrait');
            
            return $pdf->stream('Inventario_' . $inventario->n_inventario . '.pdf');
    }

    /**
     * Generar PDF de todos los inventarios
     */
    public function pdfTodas()
    {
            
            $inventarios = Inventario::orderBy('id', 'desc')->get();
            
            if ($inventarios->isEmpty()) {
                return redirect()->back()
                    ->with('error', 'No hay inventarios para generar PDF');
            }
            
            $pdf = Pdf::loadView('inventario.pdf-todas', compact('inventarios'))
                ->setPaper([0, 0, 396, 360], 'portrait');
            
            return $pdf->stream('Inventarios_' . date('Y-m-d') . '.pdf');
    }

    public function pdfCliente($clienteId)
    {
    $inventarios = Inventario::with([
        'facturacion:id,id_informacion,ci_nit,estado',
        'facturacion.informacion:id,nombre,apellido_paterno,apellido_materno'
    ])
    ->whereHas('facturacion', function ($q) use ($clienteId) {
        $q->where('id_informacion', $clienteId);
    })
    ->orderBy('id', 'desc')
    ->get();
    

    if ($inventarios->isEmpty()) {
        return redirect()->back()
            ->with('error', 'No hay inventarios para este cliente');
    }

    $primeraInventario = $inventarios->first();
            $clienteNombre = 'Cliente';

            if ($primeraInventario->facturacion && $primeraInventario->facturacion->informacion) {
                $nombre = $primeraInventario->facturacion->informacion->nombre ?? '';
                $apellido = $primeraInventario->facturacion->informacion->apellido_paterno ?? '';
                $clienteNombre = trim($nombre . ' ' . $apellido);
                $clienteNombre = !empty($clienteNombre) ? str_replace(' ', '_', $clienteNombre) : 'Cliente';
            }


    $pdf = Pdf::loadView('inventario.pdf', compact('inventarios'))
        ->setPaper([0, 0, 396, 360], 'portrait');

    return $pdf->stream('Inventarios' . $clienteId . '.pdf');
    }

}