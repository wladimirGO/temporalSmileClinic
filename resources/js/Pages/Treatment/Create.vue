<template>
  <app-layout title="Crear Tratamiento">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fas fa-users"></i> Módulo de Tratamientos
      </h2>
    </template>
    <dashboard-layout>
      <div class="md:col-span-4 mt-1">
        <div class="shadow bg-white md:rounded-md p-4">
          <form-errors :errors="errors"></form-errors>
          <form @submit.prevent="submit">
            <label class="block font-medium text-sm text-gray-700"
              >Nombre</label
            >
            <input
              :class="{ error: isActive, 'text-danger': hasError }"
              type="text"
              v-model="form.name"
              required
              class="form-input w-full rounded-md shadow-sm"
            />

            <label class="block font-medium text-sm text-gray-700"
              >Descripción</label
            >
            <input
              type="text"
              v-model="form.description"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
            <label class="block font-medium text-sm text-gray-700">Precio</label>
            <input
              type="text"
              v-model="form.price"
              required
              class="form-input w-full rounded-md shadow-sm"
            />
            <button
              class="
                bg-blue-500
                hover:bg-blue-700
                rounded-md
                text-white
                font-bold
                mt-2
                py-2
                px-4
              "
            >
              Crear
            </button>
            <Link
              class="
                bg-gray-200
                w-1/12
                hover:bg-blue-700 hover:text-white
                rounded-md
                text-black
                mt-2
                ml-2
                py-2
                px-4
              "
              :href="route('tratamientos.index')"
            >
              Cancelar</Link
            >
          </form>
        </div>
      </div>
    </dashboard-layout>
  </app-layout>
</template>

<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import FormErrors from "@/Components/FormErrors.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
export default {
  components: {
    AppLayout,
    Link,
    FormErrors,
    DashboardLayout,
  },
  data() {
    return {
      form: {
        name: "",
        description: "",
        price: ""
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.post(this.route("tratamientos.store"), { ...this.form });
    },
  },
  props: {
    errors: Object,
  },
};
</script>