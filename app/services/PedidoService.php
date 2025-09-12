<?php

namespace App\Services;

use App\Models\Mecanica;
use App\Models\Pedido;
use App\Models\ItemPedido;
use Illuminate\Support\Facades\DB;
use App\Models\Produto;

class PedidoService
{
    /** 
    * @param array $data
    * @return Pedido
    */
     
    public function criarPedido(array $data)
    {
        return DB::transaction(function () use ($data){

            $pedido = Pedido::create([
                'mecanica_id' => $data['mecanica_id'],
                'status' => 'pendente',
                'endereco_entrega' => $data['endereco_entrega'],
                'metodo_pagamento' => $data['metodo_pagamento'], 
            ]);

            $valorTotal = 0;

            foreach ($data ['items'] as $item){
                $produto = Produto::findOrFail($item['produto_id']);
                $subtotal = $produto->preco * $item['quantidade'];
                $valorTotal += $subtotal;

                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                ]);
            }

            $pedido->update(['valor_total' => $valorTotal]);

            return $pedido;
        });
    }

    /**
     * @param Pedido $pedido
     * @param array $data
     * @return Pedido
     */
    
    public function atualizarPedido(Pedido $pedido, array $data)
    {
        return DB::transaction(function () use ($pedido, $data){

            $pedido->itensPedido()->delete();
            $valorTotal = 0;

            foreach ($data['items'] as $item){
                $produto = Mecanica::findOrFail($item['produto_id']);
                $subtotal = $produto->preco * $item['quantidade'];
                $valorTotal += $subtotal;

                ItemPedido::create([
                    'pedido_id' => $pedido->id,
                    'produto_id' => $produto->id,
                    'quantidade' => $item['quantidade'],
                    'preco_unitario' => $produto->preco,
                ]);
            }

            $pedido->update([
                'valor_total' => $valorTotal,
                'endereco_entrega' => $data['endereco_entrega'] ?? $pedido->endereco_entrega,
                'metodo_pagamento' => $data['metodo_pagamento'] ?? $pedido->metodo_pagamento,
            ]);

            return $pedido;
        });
    }

    /**
     * @param Pedido $pedido
     * @return void
     */

    public function cancelarPedido(Pedido $pedido)
    {
        $pedido->update(['status' => 'cancelado']);
    }

    public function confirmarPedido(Pedido $pedido)
    {
        if ($pedido->status !== 'pendente') {
            throw new \Exception('Apenas pedidos pendentes podem ser confirmados');
        }

        return DB::transaction(function () use ($pedido){
            foreach ($pedido->itensPedido as $item){

                $produto = $item->produto->lockForUpdate()->first();
                if ($produto->estoque < $item->quantidade) {
                    throw new \Exception("Estoque insuficiente para o {$produto->nome}");
                }

                $produto->estoque -= $item->quantidade;
                $produto->save();
            }

            $pedido->status = 'confirmado';
            $pedido->save();

            return $pedido;
        });
    }
}