<template>
  <div class="charts__right">
    <div class="charts__right__title flex items-center justify-between">
      <div>
        <h1>{{title}}</h1>
        <p>{{subtitle}}</p>
      </div>
    </div>
    <apexchart :type="typecharts" :options="options" :series="series"></apexchart>
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
    typecharts: String,
  },
  data: function () {
    return {
      options: {
        chart: {
          id: "citasdia",
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
          name: "Citas por dia",
          data: this.values,
        },
      ],
    };
  },
});
</script>
