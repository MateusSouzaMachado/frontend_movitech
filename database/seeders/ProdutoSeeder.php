<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Produto;
use App\Models\Categoria;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class ProdutoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
       Schema::disableForeignKeyConstraints();

       DB::table('item_pedidos')->truncate();
       DB::table('produtos')->truncate();

       Schema::enableForeignKeyConstraints();

        // 2. Busca todas as categorias existentes no banco de dados
        $categorias = Categoria::all();

        // 3. Listas de dados de exemplo para deixar os produtos mais realistas
        $marcas = ['Bosch', 'Cofap', 'SKF', 'Magneti Marelli', 'NGK', 'Valeo', 'Fras-le', 'Luk'];
        $veiculos = [
            'VW Gol' => '2015-2020',
            'Fiat Palio' => '2012-2018',
            'Chevrolet Onix' => '2016-2021',
            'Hyundai HB20' => '2017-2022',
            'Ford Ka' => '2014-2019',
            'Renault Sandero' => '2015-2020',
        ];

        // 4. Cria 50 produtos de exemplo
        for ($i = 0; $i < 50; $i++) {
            
            // Pega uma categoria e um veículo aleatório para cada produto
            $categoriaAleatoria = $categorias->random();
            $modeloVeiculoAleatorio = array_rand($veiculos);
            $anoVeiculoAleatorio = $veiculos[$modeloVeiculoAleatorio];
            $marcaAleatoria = $marcas[array_rand($marcas)];

            Produto::create([
                'nome' => $categoriaAleatoria->nome . ' ' . $marcaAleatoria . ' para ' . $modeloVeiculoAleatorio,
                'descricao' => 'Descrição detalhada para ' . $categoriaAleatoria->nome . '. Peça de alta qualidade e durabilidade, fabricada por ' . $marcaAleatoria . '.',
                'codigo_peca' => strtoupper(Str::random(3)) . '-' . fake()->unique()->numberBetween(10000, 99999),
                'marca' => $marcaAleatoria,
                'modelo_veiculo' => $modeloVeiculoAleatorio,
                'ano_veiculo' => $anoVeiculoAleatorio,
                'preco' => fake()->randomFloat(2, 30, 950), // Preço entre R$30,00 e R$950,00
                'categoria_id' => $categoriaAleatoria->id,
            ]);
        }
    }
    
}

