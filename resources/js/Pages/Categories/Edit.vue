<script setup>
import { useForm } from '@inertiajs/vue3'
const props = defineProps({
  category: Object,  // Asegúrate de que esta prop está siendo pasada correctamente
})

const form = useForm({
  name: props.category.name, // Asigna los valores de la categoría
  description: props.category.description,
})

function submit() {
  form.put(`/categories/${props.category.id}`)
}
</script>

<template>
  <div class="flex items-center justify-center p-12">
    <div class="mx-auto w-full max-w-[550px] bg-white p-6 rounded-lg shadow-md">
      <h1 class="text-2xl font-bold mb-6 text-center text-[#07074D]">Editar Categoría</h1>
      <form @submit.prevent="submit">
        <!-- Nombre -->
        <div class="mb-5">
          <label for="name" class="mb-3 block text-base font-medium text-[#07074D]">
            Nombre de la Categoría
          </label>
          <input v-model="form.name" type="text" name="name" id="name" placeholder="Ej. Ferretería"
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md" />
          <div v-if="form.errors.name" class="text-red-500 text-sm mt-1">{{ form.errors.name }}</div>
        </div>

        <!-- Descripción -->
        <div class="mb-5">
          <label for="description" class="mb-3 block text-base font-medium text-[#07074D]">
            Descripción
          </label>
          <textarea v-model="form.description" name="description" id="description"
            placeholder="Describe la categoría..."
            class="w-full rounded-md border border-[#e0e0e0] bg-white py-3 px-6 text-base font-medium text-[#6B7280] outline-none focus:border-[#6A64F1] focus:shadow-md"></textarea>
        </div>

        <!-- Botón -->
        <div>
          <button type="submit"
            class="hover:shadow-form w-full rounded-md bg-[#6A64F1] py-3 px-8 text-center text-base font-semibold text-white outline-none">
            Guardar Cambios
          </button>
        </div>
      </form>
    </div>
  </div>
</template>
