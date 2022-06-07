<template>
  <app-layout title="Editar Usuario">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Modulo de Usuarios
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
              type="text"
              v-model="form.name"
              required
              class="form-input w-full rounded-md shadow-sm"
            />

            <label class="block font-medium text-sm text-gray-700"
              >Nro. Telefonico</label
            >
            <input
              type="text"
              v-model="form.phone_number"
              required
              class="form-input w-full rounded-md shadow-sm"
            />

            <label class="block font-medium text-sm text-gray-700">DNI</label>
            <input
              type="text"
              v-model="form.dni"
              required
              class="form-input w-full rounded-md shadow-sm"
            />

            <label class="block text-left w-full">
              <span class="text-gray-700">Rol</span>
              <select
                required
                v-model="form.rol_id"
                class="form-select block w-full mt-1"
              >
                <option selected value="-1">Selecciona un Rol</option>
                <option v-for="rol in roles" :key="rol.id" :value="rol.id">
                  {{ rol.name }}
                </option>
              </select>
            </label>

            <label class="block font-medium text-sm text-gray-700"
              >Dirección</label
            >
            <input
              type="text"
              v-model="form.address"
              required
              class="form-input w-full rounded-md shadow-sm"
            />

            <label class="block font-medium text-sm text-gray-700">Email</label>
            <input
              type="email"
              v-model="form.email"
              required
              class="form-input w-full rounded-md shadow-sm"
            />

            <label class="block font-medium text-sm text-gray-700"
              >Contraseña</label
            >
            <input
              type="password"
              v-model="form.password"
              class="form-input w-full rounded-md shadow-sm"
              autocomplete="new-password"
            />

            <label class="block font-medium text-sm text-gray-700"
              >Confirmar Contraseña</label
            >
            <input
              type="password"
              v-model="form.password_confirmation"
              class="form-input mb-4 w-full rounded-md shadow-sm"
              autocomplete="new-password"
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
              Actualizar
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
              :href="route('usuarios.index')"
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
  props: {
    roles: Array,
    usershow: Object,
    errors: Array,
  },
  data() {
    return {
      form: {
        name: this.usershow.name,
        dni: this.usershow.dni,
        phone_number: this.usershow.phone_number.replace(/[^0-9]/g, ''),
        address: this.usershow.address,
        email: this.usershow.email,
        rol_id: this.usershow.rol_id,
        password: null,
        password_confirmation: null,
      },
    };
  },
  methods: {
    submit() {
      this.$inertia.put(this.route("usuarios.update", this.usershow.id), {
        ...this.form,
      });
    },
  },
};
</script>
