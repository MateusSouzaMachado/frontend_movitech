<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

defineProps({
    produtos: Array
});
</script>

<template>
    <Head title="MoviTech" />

    <FrontendLayout>
        <div class="max-w-7xl mx-auto py-12 px-4 sm:px-6 lg:px-8">
            
            <div v-if="produtos.length > 0" class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-8">
                
                <div v-for="produto in produtos" :key="produto.id" class="bg-white rounded-lg shadow-md overflow-hidden transform hover:scale-105 transition-transform duration-300">
                    <Link :href="route('produtos.show', produto.id)">
                        <div class="h-48 bg-gray-200 flex items-center justify-center">
                            <span class="text-gray-500">Imagem</span>
                        </div>
                        
                        <div class="p-4">
                            <h3 class="font-semibold text-lg text-gray-800 truncate">{{ produto.nome }}</h3>
                            <p class="text-gray-900 font-bold mt-2">R$ {{ produto.preco }}</p>
                        </div>
                    </Link>
                </div>

            </div>

            <div v-else>
                <p class="text-center text-gray-500">Nenhum produto encontrado.</p>
            </div>
            
        </div>
    </FrontendLayout>
</template>