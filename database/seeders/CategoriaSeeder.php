<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Categoria;

class CategoriaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categorias = [
            // Sistema de Motor
            'Motor e Componentes',
            'Correias e Polias',
            'Filtros (Ar, Óleo, Combustível)',
            'Ignição e Velas',
            'Injeção Eletrônica',
            'Sistema de Arrefecimento',

            // Freios
            'Discos e Tambores de Freio',
            'Pastilhas e Lonas de Freio',
            'Cilindros e Sistemas Hidráulicos',
            'Fluidos de Freio',

            // Suspensão e Direção
            'Amortecedores e Molas',
            'Pivôs e Terminais de Direção',
            'Caixa de Direção',
            'Juntas Homocinéticas',

            // Transmissão
            'Kit de Embreagem',
            'Câmbio e Componentes',
            'Óleos e Fluidos de Transmissão',

            // Elétrica e Iluminação
            'Baterias e Alternadores',
            'Motor de Partida',
            'Faróis, Lanternas e Lâmpadas',
            'Sensores e Módulos',

            // Sistema de Exaustão
            'Escapamentos e Silenciosos',
            'Catalisadores',
            'Sondas Lambda',

            // Acessórios e Acabamento
            'Palhetas do Limpador',
            'Rolamentos e Cubos de Roda',
            'Pneus e Rodas',
            'Óleos e Lubrificantes',
            'Aditivos',
        ];

        foreach ($categorias as $nomeCategoria) {
            Categoria::create(['nome' => $nomeCategoria]);
        }
    }
}
