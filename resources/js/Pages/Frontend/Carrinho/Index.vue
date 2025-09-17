<script setup>
import { Head, Link } from '@inertiajs/vue3';
import FrontendLayout from '@/Layouts/FrontendLayout.vue';

defineProps({
    carrinho: Object,
    total: String
});
</script>

<template>
    <Head title="Seu Carrinho" />

    <FrontendLayout>
        <div class="max-w-4xl mx-auto p-4 sm:p-6 lg:p-8">
            <h1 class="text-3xl font-bold mb-6 text-gray-800">Seu Carrinho de Compras</h1>

            <div v-if="Object.keys(carrinho).length > 0" class="bg-white shadow-md rounded-lg p-6">

                <div v-for="(item, id) in carrinho" :key="id" class="flex flex-wrap items-center justify-between border-b py-4">
                    <div class="w-full sm:w-1/2">
                        <h2 class="font-semibold text-lg">{{ item.nome }}</h2>
                        <p class="text-sm text-gray-600">Preço Unitário: R$ {{ item.preco }}</p>
                    </div>
                    <div class="w-1/2 sm:w-auto text-center mt-2 sm:mt-0">
                        <p>Quantidade: {{ item.quantidade }}</p>
                    </div>
                    <div class="w-1/2 sm:w-auto text-right mt-2 sm:mt-0">
                        <Link 
                            :href="route('carrinho.destroy', id)" 
                            method="delete" 
                            as="button" 
                            class="text-red-500 hover:text-red-700 font-semibold"
                        >
                            Remover
                        </Link>
                    </div>
                </div>

                <div class="mt-6 text-right">
                    <p class="text-2xl font-bold text-gray-900">Total: R$ {{ total }}</p>
                    <button class="mt-4 bg-indigo-600 text-white font-bold py-3 px-6 rounded-lg hover:bg-indigo-700">
                        Finalizar Compra
                    </button>
                </div>

            </div>

            <div v-else class="text-center py-12">
               </div>
        </div>
    </FrontendLayout>
</template>