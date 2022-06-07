<template>
  <app-layout title="Dashboard">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        Dashboard
      </h2>
    </template>
    <dashboard-layout>
      <div class="main__cards m-3 p-3">
        <div class="card flex flex-col justify-around">
          <i class="far fa-user fa-2x text-lightblue" aria-hidden="true"></i>
          <div class="card_inner">
            <p class="text-primary-p">Número de Pacientes</p>
            <span class="font-bold text-title">{{ nPatients }}</span>
          </div>
        </div>
        <div class="card flex flex-col justify-around">
          <i class="far fa-calendar-alt fa-2x text-red" aria-hidden="true"></i>
          <div class="card_inner">
            <p class="text-primary-p nCita">Número de Citas Registradas</p>
            <span class="font-bold text-title">{{nPatients}}</span>
          </div>
        </div>
        <div class="card flex flex-col justify-around">
          <i class="fas fa-user-md fa-2x text-green-600" aria-hidden="true"></i>
          <div class="card_inner">
            <p class="text-primary-p">Número de Odontólogos</p>
            <span class="font-bold text-title">{{ nDentists }}</span>
          </div>
        </div>
      </div>
       <div class="flex flex-wrap justify-end items-center mb-4">
            <div class="grid mr-2  ">
              <span class="text-xs text-gray-400"> Fecha Inicio</span>
              <input
                :max="dateEnd"
                type="date"
                class="form-input rounded-md shadow-sm"
                v-model="dateStart"
              />
            </div>
            <div class="grid ">
              <span class="text-xs text-gray-400"> Fecha Fin</span>
              <input
                :max="dateEnd"
                type="date"
                class="form-input rounded-md shadow-sm"
                v-model="dateEnd"
              />
              
            </div>
            <button @click="searchDate" class="bg-blue-500
                hover:bg-blue-700
                md:h-1/2
                rounded-md
                text-white
                font-bold
                ml-2
                py-2
                mr-4
                mt-4
                px-4"><i class="fas fa-search"></i></button>
          </div>
      <div class="charts">
        <div >
          <area-charts
            class=" w-full"
            title="Tratamientos Solicitados"
            subtitle="Tratamientos más Solicitados"
            :names="st1n"
            :values="st1v"
            typecharts="area"
          ></area-charts>
        </div>
        <div>
          <bar-charts 
          class=" w-full"
            title="Citas Por Día"
            subtitle="Resumen Estadístico de Citas"
            :names="cpdn"
            :values="cpdv"
            typecharts="line">

          </bar-charts>
        </div>
        
      </div>
    </dashboard-layout>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import VueApexCharts from "vue3-apexcharts";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import AreaCharts from "@/Components/AreaCharts.vue";
import BarCharts from  "@/Components/BarCharts.vue";

export default defineComponent({
  components: {
    AppLayout,
    VueApexCharts,
    DashboardLayout,
    AreaCharts,
    BarCharts,
  },
  props: {
    nPatients: Number,
    nDentists: Number,
    nAppointments: Number,
    st1n: Array,
    st1v: Array,
    endDate: Date,
    initDate: Date,
    cpdv: Array,
    cpdn: Array,
  },
  data() {
    return {
      dateStart: this.initDate,
      dateEnd: this.endDate,
    };
  },
  methods: {
    searchDate(){
      this.$inertia.get(this.route("dashboard", { dateStart: this.dateStart, dateEnd: this.dateEnd }));
    }
  }
});
</script>
