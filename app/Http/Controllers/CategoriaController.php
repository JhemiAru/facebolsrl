<?php

namespace App\Http\COntrollers;

use App\Models\Categoria;
use Illuminate\Http\Request;

class CategoriaController extends Controller
{
    public function index()
    {
        $categoria = Categoria::all();
        return view('categorias.index', compact('categoria'));        
    }

    public function create()
    {
        $categoria = new Categoria();
        return view('categorias.create', compact('categoria'));
    }

    public function store(Request $request){
        
    $categoria = new Categoria();

        $categoria->nombre = mb_strtoupper($request->nombre);
        $categoria->descripcion = mb_strtoupper($request->descripcion);

        $categoria->save();

        return redirect()->route('categorias.index')->with('mensaje', 'Se registro la categoria de la manera correcta');
    }

    public function edit($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.edit', compact('categoria'));
    }

    public function update(Request $request, $id){

        $categoria = Categoria::find($id);

        $categoria->nombre = mb_strtoupper($request->nombre);
        $categoria->descripcion = mb_strtoupper($request->descripcion);

        $categoria->save();

        return redirect()->route('categorias.index')->with('mensaje', 'Se Actualizó la categoria de manera correcta');
    }

    public function show($id)
    {
        $categoria = Categoria::findOrFail($id);
        return view('categorias.show', compact('categoria')); 
    }

    public function destroy($id)
    {
        Categoria::destroy($id);
        return redirect()->route('categorias.index')->with('mensaje', 'Se elimino la categoria de la manera correcta'); 
    }
}