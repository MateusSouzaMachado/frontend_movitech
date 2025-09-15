<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use App\Models\MovimentacaoEstoque;
use App\Models\Estoque;
use App\Models\Administrador;

class MovimentacaoEstoqueController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json(MovimentacaoEstoque::with(['estoque', 'responsavel'])->get());
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
         $validated = $request->validate([
            'estoque_id' => [
                'required',
                'exists:estoques,id',
                // Validação customizada para verificar se o produto está ativo
                function ($attribute, $value, $fail) {
                    $estoque = Estoque::find($value);
                    if ($estoque && !$estoque->produto->ativo) {
                        $fail('Não é possível adicionar movimentação para um produto inativo.');
                    }
                },
            ],
            'responsavel_id' => 'nullable|exists:administradores,id',
            'tipo' => 'required|in:entrada,saida_venda,ajuste_manual',
            'quantidade' => 'required|integer|min:1',
            'motivo' => 'nullable|string|max:255',
        ]);

        $movimentacao = DB::transaction(function ()use ($validated){

            $estoque = Estoque::lockForUpdate()->findOrFail($validated['estoque_id']);

            switch ($validated['tipo']){
                case 'entrada':
                    $estoque->quantidade += $validated['quantidade'];
                    break;
                case 'saida_venda':
                case 'ajuste_manual':
                    if ($estoque->quantidade < $validated['quantidade']){
                        throw new \Exception('Estoque insuficiente para realizar a saída.');
                    }
                    $estoque->quantidade -= $validated['quantidade'];
                    break;
            }

        $estoque->save();

        $movimentacao = MovimentacaoEstoque::create($validated);

        return $movimentacao;

        });

         
        return response()->json($movimentacao, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return response()->json(MovimentacaoEstoque::with(['estoque', 'responsavel'])->findOrFail($id));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        return response()->json([
            'message' => 'Alterar movimentações de estoque não é permitido para garantir a integridade dos dados.'
        ], 403);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
          return response()->json([
            'message' => 'Excluir movimentações de estoque não é permitido para garantir a integridade dos dados.'
        ], 403);
    }
}
