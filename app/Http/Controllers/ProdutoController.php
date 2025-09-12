<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Estoque;
use App\Models\MovimentacaoEstoque;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return Produto::with('estoque')->get();
        // return Produto::all();
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $produto = Produto::create($request->all());
    
        // Cria o estoque vinculado ao produto
        $estoque = Estoque::create([
            'produto_id' => $produto->id,
            'quantidade' => $request->input('quantidade', 0), // valor inicial
            'quantidade_minima' => $request->input('quantidade_minima', 1), // valor inicial
        ]);

        MovimentacaoEstoque::create([
            'estoque_id' => $estoque->id,
            'responsavel_id' => auth()->id(), // ou outro campo
            'tipo' => 'entrada',
            'quantidade' => $estoque->quantidade,
            'motivo' => 'Cadastro inicial do produto',
        ]);

        return response()->json($produto->load('estoque.movimentacoes'), 201);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return Produto::with('estoque')->findOrFail($id);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
         $produto = Produto::findOrFail($id);

        // Verifica se o produto está desativado
        if (!$produto->ativo) {
            return response()->json([
                'message' => 'Não é possível atualizar um produto inativo.'
            ], 403); // Código 403 significa "Proibido"
        }

        // Se o produto estiver ativo, continua com a validação e atualização
        $validated = $request->validate([
            'nome' => 'required|string|max:255',
            // Adicione outras regras de validação para os campos que podem ser alterados
        ]);

         $produto->update($validated);

        return response()->json([
            'message' => 'Produto atualizado com sucesso!',
            'produto' => $produto
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
    $produto = Produto::findOrFail($id);
        
        $produto->ativo = false;
        $produto->save();

        return response()->json([
            'message' => 'Produto desativado com sucesso. O histórico de estoque foi preservado.'
        ]);
    }
}
