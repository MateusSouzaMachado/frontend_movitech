<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;

class CarrinhoController extends Controller
{
     public function store(Produto $produto)
    {
        // 1. Pega o carrinho da sessão atual, ou cria um array vazio se não existir
        $carrinho = session()->get('carrinho', []);

        // 2. Verifica se o produto já está no carrinho
        if(isset($carrinho[$produto->id])) {
            // Se sim, incrementa a quantidade
            $carrinho[$produto->id]['quantidade']++;
        } else {
            // Se não, adiciona o produto ao carrinho com quantidade 1
            $carrinho[$produto->id] = [
                "nome" => $produto->nome,
                "quantidade" => 1,
                "preco" => $produto->preco,
                // adicione 'imagem' => $produto->imagem se tiver
            ];
        }

        // 3. Salva o carrinho atualizado de volta na sessão
        session()->put('carrinho', $carrinho);

        // 4. Redireciona o usuário de volta para a página anterior
        //    com uma mensagem de sucesso (flash message)
        return redirect()->back()->with('success', 'Produto adicionado ao carrinho!');
    }
}
