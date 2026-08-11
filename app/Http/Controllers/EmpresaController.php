<?php

namespace App\Http\Controllers;

use App\Models\Empresa;
use App\Models\Categoria;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;


class EmpresaController extends Controller
{
    /* ============================================================
       INDEX: Carga empresas con cache
    ============================================================ */
    public function index()
    {
        $empresas = Cache::remember('empresas_todas', 3600, fn() =>
            Empresa::latest()->get()
        );

        return view('empresas.index', compact('empresas'));
    }

    /* ============================================================
       CREATE: Solo retorna vista
    ============================================================ */
    public function create()
    {
        $categorias = Categoria::all();
        return view('empresas.create', compact('categorias'));
    }

    /* ============================================================
       STORE: Crear empresa
    ============================================================ */
    public function store(Request $request)
    {
        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'propietario' => 'required|string|max:255',
            'celular' => 'required|string|max:15',
            'correo' => 'required|email|unique:empresas,correo',
            'descripcion' => 'required|string',
            'nit' => 'required|string',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'ubicacion' => 'required|string',
            'icono' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_categoria' => 'required|exists:categorias,id'
        ]);

        /* ========= PROCESO DE ARCHIVO ========= */
        $paths = $this->guardarIcono($request->file('icono'));

        /* ========= PROCESO DE CELULAR ========= */
        $celularCompleto = $this->procesarTelefono($request->prefijo, $request->celular);

        Empresa::create([
            'nombre_empresa' => mb_strtoupper($request->nombre_empresa),
            'propietario' => mb_strtoupper($request->propietario),
            'celular' => $celularCompleto,
            'correo' => $request->correo,
            'descripcion' => mb_strtoupper($request->descripcion),
            'nit' => $request->nit,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'ubicacion' => mb_strtoupper($request->ubicacion),
            'icono' => $paths['ruta'],
            'icono_url' => $paths['url'],
            'estado' => 1,
            'id_categoria' => $request->id_categoria,
        ]);

        Cache::forget('empresas_todas');

        return redirect()->route('empresas.index')->with('success', 'Empresa registrada correctamente.');
    }

    /* ============================================================
       SHOW
    ============================================================ */
    public function show($id)
    {
        return view('empresas.show', [
            'empresa' => Empresa::findOrFail($id)
        ]);
    }

    /* ============================================================
       EDIT
    ============================================================ */
    public function edit($id)
    {
        $categorias = Categoria::all();
        return view('empresas.edit', ['empresa' => Empresa::findOrFail($id), 'categorias' => $categorias
    ]);
    }

    /* ============================================================
       UPDATE
    ============================================================ */
    public function update(Request $request, $id)
    {
        $empresa = Empresa::findOrFail($id);

        $request->validate([
            'nombre_empresa' => 'required|string|max:255',
            'propietario' => 'required|string|max:255',
            'celular' => 'required|string|max:15',
            'correo' => 'required|email|unique:empresas,correo,' . $empresa->id,
            'descripcion' => 'required|string',
            'nit' => 'required|string',
            'longitud' => 'required|numeric',
            'latitud' => 'required|numeric',
            'ubicacion' => 'required|string',
            'icono' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'id_categoria' => 'required|exists:categorias,id'
        ]);

        /* ========= ARCHIVO ========== */
        $paths = [
            'ruta' => $empresa->icono,
            'url' => $empresa->icono_url
        ];

        if ($request->hasFile('icono')) {
            $this->eliminarIconoAnterior($empresa->icono);
            $paths = $this->guardarIcono($request->file('icono'));
        }

        /* ========= CELULAR ========== */
        $celularCompleto = $this->procesarTelefono($request->prefijo, $request->celular);

        /* ========= ACTUALIZAR ========== */
        $empresa->update([
            'nombre_empresa' => mb_strtoupper($request->nombre_empresa),
            'propietario' => mb_strtoupper($request->propietario),
            'celular' => $celularCompleto,
            'correo' => $request->correo,
            'descripcion' => mb_strtoupper($request->descripcion),
            'nit' => $request->nit,
            'longitud' => $request->longitud,
            'latitud' => $request->latitud,
            'ubicacion' => mb_strtoupper($request->ubicacion),
            'icono' => $paths['ruta'],
            'icono_url' => $paths['url'],
            'estado' => $request->estado,
            'id_categoria' => $request->id_categoria,
        ]);

        Cache::forget('empresas_todas');

        return redirect()->route('empresas.index')->with('success', 'Empresa actualizada correctamente.');
    }

    /* ============================================================
       DESTROY
    ============================================================ */
    public function destroy($id)
    {
        $empresa = Empresa::findOrFail($id);

        $this->eliminarIconoAnterior($empresa->icono);

        $empresa->delete();

        Cache::forget('empresas_todas');

        return redirect()->route('empresas.index')->with('success', 'Empresa eliminada correctamente.');
    }

    /* ============================================================
       MÉTODOS AUXILIARES (reutilizables)
    ============================================================ */

    private function guardarIcono($archivo)
    {
        $carpeta = public_path('uploads/iconos');

        if (!File::exists($carpeta)) {
            File::makeDirectory($carpeta, 0777, true, true);
        }

        $nombre = time() . '_' . preg_replace('/\s+/', '_', $archivo->getClientOriginalName());
        $archivo->move($carpeta, $nombre);

        $ruta = 'uploads/iconos/' . $nombre;

        return [
            'ruta' => $ruta,
            'url' => asset($ruta)
        ];
    }

    private function eliminarIconoAnterior($ruta)
    {
        if ($ruta && File::exists(public_path($ruta))) {
            File::delete(public_path($ruta));
        }
    }

    private function procesarTelefono($prefijo, $numero)
    {
        $limpio = preg_replace('/[^0-9]/', '', $numero);

        $prefijos = ['591','51','55','56','54','595'];

        foreach ($prefijos as $p) {
            if (Str::startsWith($limpio, $p)) {
                $limpio = substr($limpio, strlen($p));
                break;
            }
        }

        return str_replace('+', '', $prefijo) . $limpio;
    }
/* ============================================================
       PDF: Generar catalogo de empresas activas
    ============================================================ */
    public function pdf()
    {
      $empresas = Empresa::where('estado', 1)
            ->with(['convenios' => function ($query) {
                $query->where('estado', 1);
            }])
            ->orderBy('created_at', 'desc')
            ->orderBy('nombre_empresa', 'asc')
            ->get();

        $pdf = Pdf::loadView('pdf', compact('empresas'));

        return $pdf->stream('catalogo_empresas.pdf');
    }
}