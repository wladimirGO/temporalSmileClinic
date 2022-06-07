<template>
  <table>

    <tbody>
        <tr>
            <th class="border px-4 py-2"> Nombre</th>
            <td class="border px-4 py-2">{{ usershow.name }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> Nro. Telefonico</th>
            <td class="border px-4 py-2">{{ usershow.phone_number }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> DNI</th>
            <td class="border px-4 py-2">{{ usershow.dni }}</td>
        </tr>
        <tr>
            <th class="border px-4 py-2"> Dirección</th>
            <td class="border px-4 py-2">{{ usershow.address }}</td>
        </tr>
        <tr v-if="usershow.email">
          <th class="border px-4 py-2"> Email</th>
          <td class="border px-4 py-2">{{ usershow.email}}</td>
        </tr>
        <tr>
          <th class="border px-4 py-2"> Rol</th>
          <td class="border px-4 py-2">{{ usershow.rol.name }}</td>
        </tr>
    </tbody>
  </table>
</template>

<script>
import { defineComponent } from "vue";
export default defineComponent({
  props: {
    usershow: Object,
  },
});
</script>
