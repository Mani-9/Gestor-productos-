<script setup>
import { useForm } from '@inertiajs/vue3'

const props = defineProps({
  product: Object,
  categories: Array
})

// Asegurarse que props.product exista (cuando editas)
const form = useForm({
  name: props.product?.name || '',
  description: props.product?.description || '',
  price: props.product?.price || '',
  stock: props.product?.stock || '',
  category_id: props.product?.category_id || '',
})

function submit() {
  form.put(`/products/${props.product.id}`)
}
</script>
<template>
  <div>
    <h1 class="text-xl font-bold mb-4">Editar Producto</h1>

    <form @submit.prevent="submit">
      <input v-model="form.name" type="text" placeholder="Nombre" class="input" />
      <textarea v-model="form.description" placeholder="Descripción" class="textarea" />
      <input v-model="form.price" type="number" placeholder="Precio" class="input" />
      <input v-model="form.stock" type="number" placeholder="Stock" class="input" />

      <select v-model="form.category_id" class="select">
        <option v-for="cat in categories" :key="cat.id" :value="cat.id">
          {{ cat.name }}
        </option>
      </select>

      <button type="submit" class="btn btn-primary mt-4">Actualizar</button>
    </form>
  </div>
</template>
