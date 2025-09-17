<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Produto;
use Inertia\Inertia;

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

    public function index()
    {
        $carrinho = session()->get('carrinho', []);

        // Vamos calcular o total
        $total = 0;
        foreach ($carrinho as $item) {
            $total += $item['preco'] * $item['quantidade'];
        }
    
        return Inertia::render('Frontend/Carrinho/Index', [
            'carrinho' => $carrinho,
            'total' => number_format($total, 2, ',', '.') // Formatando para Reais
        ]);
    }

    public function destroy(Produto $produto)
{
    $carrinho = session()->get('carrinho', []);

    // Verifica se o produto realmente existe no carrinho
    if (isset($carrinho[$produto->id])) {
        // Remove o item do array do carrinho
        unset($carrinho[$produto->id]);
    }

    // Salva o carrinho atualizado de volta na sessão
    session()->put('carrinho', $carrinho);

    // Redireciona de volta para a página do carrinho
    return redirect()->back()->with('success', 'Produto removido do carrinho!');
}
}
