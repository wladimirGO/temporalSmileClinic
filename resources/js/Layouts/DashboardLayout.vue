<template>
  <div class="pb-12 pt-0 w-full">
    <div class="max-w-full mx-auto sm:pr-0 lg:px-0">
      <div class="lg:grid lg:grid-cols-5 lg:gap-2">
        <div class="md:col-span-1 menu menuDashboard">
          <div v-if="$page.props.user.rol_id===1" class="mt-20 flex flex-row justify-center">
            <img id="iconoRol" src="/images/call.png" alt="img del rol" />
            <p class="ml-2">Bienvenido Administrador</p>
          </div>
          <div v-else class="mt-20 flex flex-row justify-center">
            <img id="iconoRol" src="/images/usuario.png" alt="img del rol" />
            <p class="ml-2">Bienvenido Doctor</p>
          </div>
          <ul class="flex flex-col mt-5 ps-2">
            <li class="m-3 mt-10">
              <Link
                :href="route('pacientes.index')"
                class="text-white p-3 mb-2 sidebar-link"
              >
                <i class="px-2 far fa-address-book text-light fa-lg mr-3"></i>
                Pacientes
              </Link>
            </li>
            <li class="m-3">
              <Link
                :href="route('citas.index')"
                class="text-white p-3 mb-2 sidebar-link"
              >
                <i
                  class="px-2 fas fa-notes-medical text-light fa-lg mr-3"
                ></i
                >Citas
              </Link>
            </li>
            <li v-if="$page.props.user.rol_id===1" class="m-3">
              <Link
                :href="route('usuarios.index')"
                class="text-white p-3 mb-2 sidebar-link"
              >
                <i class="px-2 fas fa-users text-light fa-lg mr-3"></i>Usuarios
              </Link>
            </li>
            <li v-if="$page.props.user.rol_id===1" class="m-3">
              <Link
                :href="route('tratamientos.index')"
                class="text-white p-3 mb-2 sidebar-link"
              >
                <i class="px-2 fas fa-users text-light fa-lg mr-3"></i>Tratamientos
              </Link>
            </li>
            <li class="m-3">
              <Link
                :href="route('calculadora')"
                class="text-white p-3 mb-2 sidebar-link"
              >
                <i class="px-2 fas fa-calculator text-light fa-lg mr-3"></i
                >Calculadora
              </Link>
            </li>
          </ul>
        </div>
        <div class="md:col-span-4 mt-1">
          <div class="flex flex-col">
            <slot></slot>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import VueApexCharts from "vue3-apexcharts";
import { Head, Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
  components: {
    AppLayout,
    VueApexCharts,
    Head,
    Link,
  },
  props: {
    nPatients: Number,
    nDentists: Number,
  },
  data: function () {
    return {
      options1: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
        stroke: {
          curve: "smooth",
        },
      },
      series1: [
        {
          name: "series-1",
          data: [30, 40, 45, 50, 49, 60, 70, 91],
        },
      ],
      options2: {
        chart: {
          id: "vuechart-example",
        },
        xaxis: {
          categories: [1991, 1992, 1993, 1994, 1995, 1996, 1997, 1998],
        },
        stroke: {
          curve: "smooth",
        },
      },
      series2: [
        {
          name: "series-1",
          data: [30, 40, 45, 50, 49, 60, 70, 91],
        },
      ],
    };
  },
});
</script>
