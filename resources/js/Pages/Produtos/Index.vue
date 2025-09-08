<script setup>
import { Head } from '@inertiajs/vue3';

defineProps({
    mensagem: String
});
</script>

<template>
    <Head title="Nossos Produtos" />

     <div class="p-8">
        <h1 class="text-3xl font-bold">Página de Produtos</h1>
        <p class="mt-4 text-lg text-gray-700">
            {{ mensagem }}
        </p>
    </div>
</template>
