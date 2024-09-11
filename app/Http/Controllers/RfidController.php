<?php

namespace App\Http\Controllers;

use App\Models\tarjeta;
use Illuminate\Http\Request;

class RfidController extends Controller
{
    public function index()
    {
        return response()->json(tarjeta::all());
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'data' => 'required|string|max:255',
        ]);

        $tarjeta = tarjeta::create($validatedData);

        return response()->json($tarjeta, 201);
    }

    public function show($id)
    {
        $tarjeta = tarjeta::findOrFail($id);

        return response()->json($tarjeta);
    }

    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'data' => 'required|string|max:255',
        ]);

        $tarjeta = tarjeta::findOrFail($id);
        $tarjeta->update($validatedData);

        return response()->json($tarjeta);
    }

    public function destroy($id)
    {
        $tarjeta = tarjeta::findOrFail($id);
        $tarjeta->delete();

        return response()->json(null, 204);
    }
}
