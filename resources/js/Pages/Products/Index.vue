<template>
  <div>

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

          <!-- Buscador y Filtro por categoría -->
          <div class="mb-4 flex gap-4">
            <input v-model="search" @input="buscar" type="text" class="input w-full sm:w-1/2"
              placeholder="Buscar producto..." />

            <!-- Filtro de categoría -->
            <select v-model="selectedCategory" @change="filtrarPorCategoria" class="input w-full sm:w-1/4">
              <option value="">Todas las categorías</option>
              <option v-for="category in categories" :key="category.id" :value="category.id">
                {{ category.name }}
              </option>
            </select>
          </div>

          <!-- Botón para crear nuevo producto -->
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            Crear nuevo producto
          </button>

          <!-- Modal de creación de producto -->
          <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="staticBackdropLabel">Nuevo Producto</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Cerrar"></button>
                </div>
                <div class="modal-body">
                  <div class="container">
                    <div class="card shadow-sm">
                      <div class="card-header bg-primary text-white">
                        <h5 class="mb-0">Formulario de Producto</h5>
                      </div>
                      <div class="card-body">
                        <form @submit.prevent="submit">
                          <!-- Nombre del producto -->
                          <div class="mb-3">
                            <label class="form-label">Nombre</label>
                            <input v-model="form.name" type="text" class="form-control"
                              placeholder="Nombre del producto" />
                            <div v-if="form.errors.name" class="text-danger mt-1">{{ form.errors.name }}</div>
                          </div>

                          <!-- Descripción del producto -->
                          <div class="mb-3">
                            <label class="form-label">Descripción</label>
                            <textarea v-model="form.description" class="form-control" rows="3"
                              placeholder="Descripción del producto"></textarea>
                          </div>

                          <!-- Precio del producto -->
                          <div class="mb-3">
                            <label class="form-label">Precio</label>
                            <input v-model="form.price" type="number" step="0.01" class="form-control"
                              placeholder="Precio del producto" />
                          </div>

                          <!-- Stock del producto -->
                          <div class="mb-3">
                            <label class="form-label">Stock</label>
                            <input v-model="form.stock" type="number" class="form-control"
                              placeholder="Cantidad en stock" />
                          </div>

                          <!-- Categoría del producto -->
                          <div class="mb-4">
                            <label class="form-label">Categoría</label>
                            <select v-model="form.category_id" class="form-select">
                              <option disabled value="">Seleccione una categoría</option>
                              <option v-for="category in categories" :key="category.id" :value="category.id">
                                {{ category.name }}
                              </option>
                            </select>
                          </div>

                          <!-- Botón para guardar -->
                          <div class="d-grid modal-footer">
                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                            <button class="btn btn-success">Guardar</button>
                          </div>
                        </form>
                      </div>
                    </div>
                  </div>
                </div>
              </div>
            </div>
          </div>


          <!-- Tabla de productos -->
          <table class="table-auto w-full">
            <thead>
              <tr>
                <th>Nombre</th>
                <th>Descripción</th>
                <th>Categoría</th>
                <th>Precio</th>
                <th>Stock</th>
                <th>Acciones</th>
              </tr>
            </thead>
            <tbody>
              <tr v-for="product in products.data" :key="product.id">
                <td>{{ product.name }}</td>
                <td>{{ product.description }}</td>
                <td>{{ product.category ? product.category.name : 'Sin categoría' }}</td>
                <td>{{ product.price }}</td>
                <td>{{ product.stock }}</td>
                <td>
                  <Link :href="`/products/${product.id}/edit`" class="btn btn-sm btn-warning">Editar</Link>
                  <button @click="eliminar(product.id)" class="btn btn-sm btn-danger ml-2">Eliminar</button>
                </td>
              </tr>
            </tbody>
          </table>

          <!-- Paginación -->
          <div class="mt-4">
            <button v-if="products.prev_page_url" @click="cargarPagina(products.prev_page_url)"
              class="btn btn-secondary mr-2">
              Anterior
            </button>
            <button v-if="products.next_page_url" @click="cargarPagina(products.next_page_url)"
              class="btn btn-secondary">
              Siguiente
            </button>
          </div>
        </div>
      </div>
      </div>
    </AuthenticatedLayout>
  </div>
</template>



<script setup>
import { ref, watch } from 'vue'
import { router, Link } from '@inertiajs/vue3'
import debounce from 'lodash/debounce'
import { Head } from '@inertiajs/vue3';
import AuthenticatedLayout from '@/Layouts/AuthenticatedLayout.vue';

const props = defineProps({
  products: Object, // Paginated products
  filters: Object,
  categories: Array,
})

const search = ref(props.filters.search || '')
const selectedCategory = ref(props.filters.category_id || '')

// Buscar productos
const buscar = debounce(() => {
  router.get('/products', { search: search.value, category_id: selectedCategory.value }, { preserveState: true, replace: true })
}, 300)

// Filtrar por categoría
function filtrarPorCategoria() {
  router.get('/products', { search: search.value, category_id: selectedCategory.value }, { preserveState: true, replace: true })
}

// Eliminar producto
function eliminar(id) {
  if (confirm('¿Eliminar este producto?')) {
    router.delete(`/products/${id}`)
  }
}

// Cargar una página de productos (paginación)
function cargarPagina(url) {
  router.get(url, { search: search.value, category_id: selectedCategory.value }, { preserveState: true, replace: true })
}
import { useForm } from '@inertiajs/vue3'

const form = useForm({
  name: '',
  description: '',
  price: '',
  stock: '',
  category_id: '',
})


function submit() {
  form.post('/products', {
    onSuccess: () => {
      // Cerrar el modal al guardar correctamente
      const modal = bootstrap.Modal.getInstance(document.getElementById('staticBackdrop'));
      if (modal) {
        modal.hide();
      }

      // (Opcional) limpiar el formulario
      form.reset();
    }
  });
}
</script>