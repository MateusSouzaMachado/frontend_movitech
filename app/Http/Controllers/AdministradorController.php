<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Administrador;

class AdministradorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Administrador::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $administrador = Administrador::create($request->all());
        return response()->json($administrador, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Administrador::findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $administrador = Administrador::findOrFail($id);
        $administrador->update($request->all());
        return $administrador;
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
            Administrador::destroy($id);
            return response()->json(['message' => 'Administrador deletado com sucesso', 200]);
    }
}
