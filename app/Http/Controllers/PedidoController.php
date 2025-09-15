<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Services\PedidoService;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Exception;

class PedidoController extends Controller
{
  
    public function index()
    {
        
    }

    
    public function store(Request $request, PedidoService $pedidoService)
    {
     
    
        $validatedData = $request->validate([
            'mecanica_id'      => 'required|exists:mecanicas,id',
            'endereco_entrega' => 'required|string|max:255',
            'metodo_pagamento' => 'required|string',
            'items'            => 'required|array|min:1',
            'items.*.produto_id' => 'required|exists:produtos,id',
            'items.*.quantidade' => 'required|integer|min:1',
        ]);
        $pedido = $pedidoService->criarPedido($validatedData);

        return response()->json($pedido->load('itensPedido.produto'), 201);
    }

   
    public function show(string $id)
    {
        $pedido = Pedido::with('itensPedido.produto')->findOrFail($id);
        return response()->json($pedido);
    }

   
    public function update(Request $request, string $id)
    {

        $pedido = Pedido::with('itensPedido')->findOrFail($id);

        if (Carbon::now()->diffInMinutes($pedido->created_at) > 30 || $pedido->status !== 'pendente') {
            return response()->json(['error' => 'Pedido não pode mais ser alterado'], 403);
        }

        $request->validate([
            'endereco_entrega' => 'sometimes|string|max:255',
            'metodo_pagamento' => 'sometimes|string',
            'items'            => 'required|array|min:1',
            'items.*.produto_id' => 'required|exists:produtos,id',
            'items.*.quantidade' => 'required|integer|min:1',
        ]);

        $pedido = $pedidoService->atualizarPedido($pedido, $request->all());

        return response()->json($pedido->load('itensPedido.produto'));
    }

 
    public function destroy(string $id)
    {
        $pedido = Pedido::findOrFail($id);

        if ($pedido->status !== 'pendente') {
            return response()->json(['error' => 'Apenas pedidos pendentes podem ser cancelados'], 403);
        }

        $pedidoService->cancelarPedido($pedido);

        return response()->json(['message' => 'Pedido cancelado com sucesso']);
    }

    public function confirmar($id, PedidoService $pedidoService)
    {
        $pedido = Pedido::with('itensPedido.produto')->findOrFail($id);
        
        try {
            $pedidoService->confirmarPedido($pedido);
            return response()->json(['success' => 'Pedido confirmado e estoque atualizado!']);
        } catch (Exception $e) {
            return response()->json(['error' => $e->getMessage()], 400);
        }
    }
}
