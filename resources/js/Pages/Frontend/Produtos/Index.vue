<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    mensagem: String,
    produtos: Array 
});
</script>

<template>
    <Head title="Nossos Produtos" />

     <div class="p-8 max-w-4xl mx-auto">
        <h1 class="text-3xl font-bold">Página de Produtos</h1>
        <p class="mt-4 text-lg text-gray-700">
            {{ mensagem }}
        </p>
        <div class="mt-8">
            <ul class="divide-y divide-gray-200">
                <li v-for="produto in produtos" :key="produto.id" class="py-4 flex justify-between items-center">
                    <span class="text-gray-800 font-medium">{{ produto.nome }}</span>
                    <span class="text-green-600 font-semibold">{{ produto.preco }}</span> 
                </li>
            </ul>
        </div>
    </div>
</template>
