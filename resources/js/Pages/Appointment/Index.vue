<template>
  <app-layout title="Citas">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fas fa-users"></i> Módulo de Citas
      </h2>
    </template>
    <dashboard-layout>
      <div class="md:col-span-4 mt-1">
        <div class="shadow bg-white md:rounded-md p-4">
          <div class="flex justify-evenly">
            <input
            v-if="$page.props.user.rol_id===1"
              type="text"
              class="form-input rounded-md shadow-sm"
              placeholder="Buscar ..."
              v-model="q"
            />
            <input
            v-else
              type="text"
              class="form-input rounded-md shadow-sm"
              placeholder="Buscar Paciente..."
              v-model="q"
            />
            <label class="flex items-center block text-left">
              <span class="text-gray-700 pr-1">Buscar Fecha</span>
              <input
                type="date"
                class="form-input rounded-md shadow-sm"
                placeholder="Buscar Fecha"
                v-model="fecha"
              />
            </label>
            <Link v-if="$page.props.user.rol_id===1"
              :href="route('citas.create')"
              class="bg-blue-500 text-white font-bold p-2 mx-4 rounded"
              ><i class="far fa-clipboard"></i> Crear Cita</Link
            >
          </div>
          <hr class="my-6" />
          <div class="flex flex-col justify-center">
            <table-list-appointment :appointments="appointments.data" />
          </div>
        </div>
      </div>
    </dashboard-layout>
  </app-layout>
</template>
<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
import TableListAppointment from "@/Components/TableListAppointment.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
    Head,
    Link,
    TableListAppointment,
    DashboardLayout,
  },
  props: {
    appointments: Array,
  },
  watch: {
    fecha(fecha) {
      let aux;
      aux=this.q+"."+fecha;
      this.$inertia.replace(this.route("citas.index", {aux}));
    },
    q(valor) {
      let aux;
      aux=valor+"."+this.fecha;
      this.$inertia.replace(this.route("citas.index", {aux}));
    }
  },
  data() {
    return {
        q: "",
        fecha: "",
    };
  },
});
</script>
