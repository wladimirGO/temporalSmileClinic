<template>
  <app-layout title="Ver Paciente">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fas fa-users"></i> Módulo de Pacientes
      </h2>
    </template>
    <dashboard-layout>
      <div class="md:col-span-4 mt-1">
        <div class="shadow bg-white md:rounded-md p-4">
          <div class="flex flex-col justify-center">
            <table-details-patient :patient="patient" />
            <div class="flex justify-center">
              <Link
                class="
                  bg-gray-200
                  w-1/12
                  hover:bg-blue-700 hover:text-white
                  rounded-md
                  text-black
                  mt-2
                  py-2
                  px-4
                "
                :href="route('pacientes.index')"
              >
                Volver</Link
              >
            </div>
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
import TableDetailsPatient from "@/Components/TableDetailsPatient.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";

export default defineComponent({
  components: {
    AppLayout,
    Head,
    TableDetailsPatient,
    Link,
    DashboardLayout,
  },
  props: {
    patient: Object,
  },
});
</script>