<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Mecanica;

class MecanicaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Mecanica::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $mecanica = Mecanica::create($request->all());
        return response()->json($mecanica, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Mecanica::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $mecanica = Mecanica::findOrFail($id);
        $mecanica->update($request->all());
        return $mecanica;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            Mecanica::destroy($id);
            return response()->json(['message' => 'Mecanica deletada com sucesso', 200]);
    }
}
