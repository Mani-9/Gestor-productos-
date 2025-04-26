<script setup>
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';
import { Head } from '@inertiajs/vue3';
defineProps({ categories: Array })
import { Link, router } from '@inertiajs/vue3'

function eliminar(id) {
    if (confirm('¿Deseas eliminar esta categoría?')) {
        router.delete(`/categories/${id}`)
    }
}
</script>


<template>

    <Head title="Dashboard" />

    <AuthenticatedLayout>
        <template #header>
            <h2 class="text-xl font-semibold leading-tight text-gray-800">
                Categorias
            </h2>
        </template>

        <div class="py-12">
            <div class="mx-auto max-w-7xl sm:px-6 lg:px-8 ">
                <div class="overflow-hidden bg-white shadow-sm sm:rounded-lg">
                    <!-- Enlace que activa el modal -->
                    <Link href="/categories/create"
                        class="bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block hover:bg-blue-700">
                    Nueva Categoría
                    </Link>
                    <div class="px-4 sm:px-6 lg:px-8 py-4">
                        <div class="relative overflow-x-auto shadow-md sm:rounded-lg bg-white">
                            <table class="w-full text-sm text-center text-gray-700 dark:text-gray-300">
                                <thead class="text-xs uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
                                    <tr>
                                        <th scope="col" class="px-6 py-3">Nombre</th>
                                        <th scope="col" class="px-6 py-3">Descripción</th>
                                        <th scope="col" class="px-6 py-3">Acciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr v-for="categoria in categories" :key="categoria.id"
                                        class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ categoria.name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ categoria.description }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <Link :href="`/categories/${categoria.id}/edit`"
                                                class="text-blue-600 dark:text-blue-400 hover:underline">
                                            <!-- Ícono de editar -->
                                            <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block"
                                                fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                <path d="M12 20h9" />
                                                <path d="M16.5 3.5a2.121 2.121 0 1 1 3 3L7 19l-4 1 1-4 12.5-12.5z" />
                                            </svg>
                                            </Link>

                                            <button @click="eliminar(categoria.id)"
                                                class="text-red-600 dark:text-red-400 hover:underline ml-4">
                                                <!-- Ícono de eliminar -->
                                                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5 inline-block"
                                                    fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                                    <path d="M3 6h18" />
                                                    <path d="M8 6V4h8v2" />
                                                    <path d="M10 11v6" />
                                                    <path d="M14 11v6" />
                                                    <path d="M5 6l1 14h12l1-14" />
                                                </svg>
                                            </button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AuthenticatedLayout>
</template>
<style></style>