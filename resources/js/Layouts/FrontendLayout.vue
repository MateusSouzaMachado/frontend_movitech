<script setup>
import { Link } from '@inertiajs/vue3';
</script>

<template>
    <div class="bg-gray-100 min-h-screen">
        <header class="bg-white shadow sticky top-0 z-40">
            <div class="max-w-7xl mx-auto py-4 px-4 sm:px-6 lg:px-8 flex justify-between items-center">

                <Link :href="route('home')">
                    <h1 class="text-2xl font-bold text-gray-900">MoviTech</h1>
                </Link>

                <div class="flex items-center space-x-6">

                    <div v-if="$page.props.auth.user">
                        <span>Olá, {{ $page.props.auth.user.name }}</span>
                    </div>
                    <div v-else class="hidden sm:flex items-center space-x-4">
                        <Link :href="route('login')" class="font-semibold text-gray-600 hover:text-gray-900">Login</Link>
                        <Link :href="route('register')" class="font-semibold text-gray-600 hover:text-gray-900">Registrar</Link>
                    </div>

                    <Link :href="route('carrinho.index')" class="relative">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-gray-700" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M3 3h2l.4 2M7 13h10l4-8H5.4M7 13L5.4 5M7 13l-2.293 2.293c-.63.63-.184 1.707.707 1.707H17m0 0a2 2 0 100 4 2 2 0 000-4zm-8 2a2 2 0 11-4 0 2 2 0 014 0z" />
                        </svg>
                        <span v-if="$page.props.cart.count > 0" class="absolute -top-2 -right-2 bg-red-500 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">
                            {{ $page.props.cart.count }}
                        </span>
                    </Link>

                </div>
            </div>
        </header>

        <main>
            <slot />
        </main>
    </div>
</template>