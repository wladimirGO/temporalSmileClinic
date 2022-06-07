<template>
  <div class="charts__left">
    <div class="charts__left__title flex items-center justify-between">
      <div>
        <h1>{{title}}</h1>
        <p>{{subtitle}}</p>
      </div>
    </div>
    <apexchart
      ref="realtimeChart"
      :type="typecharts"
      :options="options"
      :series="series"
      style="width: 100%"
    ></apexchart>
  </div>
</template>

<script>
import { defineComponent } from "vue";
import VueApexCharts from "vue3-apexcharts";

export default defineComponent({
  components: {
    VueApexCharts,
  },
  props: {
    names: Array,
    values: Array,
    title: String,
    subtitle: String,
    typecharts: String
  },
  data () {
    return {
        options: {
        chart: {
          id: "tratamiento",
        },
        xaxis: {
          categories: this.names,
        },
        stroke: {
          curve: "smooth",
        },
      },
      series: [
        {
          name: "Tratamientos mas solicitados",
          data: this.values,
        },
      ],
    };
  },
});
</script>
