<template>
  <app-layout title="Calculadora de presupuesto">
    <template #header>
      <h2 class="font-semibold text-xl text-gray-800 leading-tight">
        <i class="fas fa-users"></i> Calculadora de presupuesto
      </h2>
    </template>
    <dashboard-layout>
       <div class="w-full bg-white p-5 m-0">
         <h2 class="font-semibold text-md text-gray-400 leading-tight">Calcula facilmente el monto de tratamientos solicitados.</h2>
       </div>
       <div class="w-full flex">

        <div class="bg-white mt-2 shadow-xl rounded-lg md:w-1/2 w-full">
          <ul class="divide-y divide-gray-300">
            <input-check v-on:sendEmitEvent="getEmitClick" v-for="treatment in treatments" :treatment="treatment" :key="treatment.id"></input-check>
          </ul>
        </div>
        <div class=" md:w-1/2 w-full">
          <facture-table :total="totalAmount" :treatmentsSelected="getTreatments"></facture-table>
        </div>
       </div>
    </dashboard-layout>
  </app-layout>
</template>

<script>
import { defineComponent } from "vue";
import AppLayout from "@/Layouts/AppLayout.vue";
import DashboardLayout from "@/Layouts/DashboardLayout.vue";
import InputCheck from "@/Components/InputCheck.vue";
import FactureTable from "@/Components/FactureTable.vue"
export default defineComponent({
  components: {
    AppLayout,
    DashboardLayout,
    InputCheck,
    FactureTable,
  },
  props: {
    treatments: Array,
  },
  data() {
    return {
      treatmentsSelected: [],
      total: 0,
    };
  },
  methods:{
    getEmitClick(data){
      if(this.treatmentsSelected.find(treatment => treatment.id == data.treatment)){
        this.treatmentsSelected=this.treatmentsSelected.filter(treatment =>{
          return treatment.id !==data.treatment;
        });
      }else{
         const treatmentSelected = this.treatments.find(treatment => treatment.id == data.treatment);
          treatmentSelected.count = data.count
        this.treatmentsSelected.push(treatmentSelected);
      }
    },

  },
  computed:{
    getTreatments(){
      return this.treatmentsSelected;
    },
    totalAmount(){
      this.total = 0;
      this.treatmentsSelected.forEach(treatment=>{

          this.total += (parseInt(treatment.price)*parseInt(treatment.count));
      })
      return parseInt(this.total);
    }
  }
  
});
</script>