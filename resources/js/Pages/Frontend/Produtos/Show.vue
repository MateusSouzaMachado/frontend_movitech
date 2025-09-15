<script setup>
import { Head, Link } from '@inertiajs/vue3';
 

// O componente recebe o objeto 'produto' como prop
defineProps({
    produto: Object,
});
</script>

<template>

    
    <Head :title="produto.nome" />

    <div class="bg-gray-100 min-h-screen">
         <header class="bg-white shadow">
            <div class="max-w-7xl mx-auto py-6 px-4 sm:px-6 lg:px-8">
                <Link :href="route('home')" class="text-indigo-600 hover:text-indigo-800">&larr; Voltar para a loja</Link>
            </div>
        </header>

        <main class="max-w-4xl mx-auto py-12">
            <div class="bg-white shadow-lg rounded-lg overflow-hidden md:flex">
                <div class="md:w-1/2 bg-gray-200 flex items-center justify-center p-8">
                     <span class="text-gray-500 text-2xl">Imagem do Produto</span>
                </div>

                <div class="md:w-1/2 p-8 flex flex-col justify-between">
                    <div>
                        <h1 class="text-3xl font-bold text-gray-900">{{ produto.nome }}</h1>
                        <p class="mt-4 text-gray-600">{{ produto.descricao }}</p> </div>

                    <div class="mt-8">
                        <span class="text-4xl font-extrabold text-gray-900">R$ {{ produto.preco }}</span>
                        <Link :href="route('carrinho.store', produto.id)" method="post" as="button" class="mt-4 w-full bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700 transition-colors duration-300">
                            Adicionar ao Carrinho
                        </Link>
                    </div>
                </div>
            </div>
        </main>
    </div>
</template>