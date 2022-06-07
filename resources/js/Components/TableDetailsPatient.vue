<template>
  <table>

    <tbody>
        <tr>
            <th class="border px-4 py-2"> DNI</th>
            <td class="border px-4 py-2">{{ patient.dni }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> Nombre</th>
            <td class="border px-4 py-2">{{ patient.name }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> Nro. Telefonico</th>
            <td class="border px-4 py-2">{{ patient.phone_number }}</td>
        </tr>
        
        <tr>
            <th class="border px-4 py-2"> Dirección</th>
            <td class="border px-4 py-2">{{ patient.address }}</td>
        </tr>
    </tbody>
  </table>
</template>
<script>
import { defineComponent } from "vue";
export default defineComponent({
  props: {
    patient: Object,
  },
});
</script>
