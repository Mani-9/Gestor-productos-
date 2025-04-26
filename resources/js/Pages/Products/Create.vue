<template>
  <div class="container mt-4">
    <div class="card shadow">
      <div class="card-header bg-primary text-white">
        <h2 class="mb-0">Nuevo Producto</h2>
      </div>
      <div class="card-body">
        <form @submit.prevent="submit">
          <div class="mb-3">
            <label class="form-label">Nombre</label>
            <input v-model="form.name" type="text" class="form-control" />
            <div v-if="form.errors.name" class="text-danger mt-1">{{ form.errors.name }}</div>
          </div>

          <div class="mb-3">
            <label class="form-label">Descripción</label>
            <textarea v-model="form.description" class="form-control" rows="3"></textarea>
          </div>

          <div class="mb-3">
            <label class="form-label">Precio</label>
            <input v-model="form.price" type="number" step="0.01" class="form-control" />
          </div>

          <div class="mb-3">
            <label class="form-label">Stock</label>
            <input v-model="form.stock" type="number" class="form-control" />
          </div>

          <div class="mb-4">
            <label class="form-label">Categoría</label>
            <select v-model="form.category_id" class="form-select">
              <option disabled value="">Seleccione una categoría</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>

          <div class="d-grid">
            <button class="btn btn-success">Guardar</button>
          </div>
        </form>
      </div>
    </div>
  </div>
</template>

<script setup>
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  description: '',
  price: '',
  stock: '',
  category_id: '',
})

const props = defineProps({
  categories: Array
})

function submit() {
  form.post('/products')
}
</script>
