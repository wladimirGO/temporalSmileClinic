<template>
  <table>
    <thead>
      <tr>
        <th class="border px-4 py-2">Fecha</th>
        <th class="border hidden md-table-cell px-4 py-2">Paciente</th>
        <th class="border hidden md-table-cell px-4 py-2">Doctor</th>
        <th class="border px-4 py-2" colspan="3">Acciones</th>
      </tr>
    </thead>
    <tbody>
      <tr v-for="appointment in appointments" :key="appointment.id">
          <td  class="border px-4 py-2">
            {{ appointment.date }} <br />{{ appointment.hour }}
          </td>
          <td class="border hidden md-table-cell px-3 py-2">
            {{ appointment.paciente }}
          </td>
          <td class="px-4 hidden md-table-cell border py-2">
            {{ appointment.doctor }}
          </td>
          <td class="px-4 py-2 border text-center">
            <Link :href="route('citas.show', appointment.id)">
              <i class="far fa-eye text-green-600"></i>
            </Link>
          </td>
          <td v-if="$page.props.user.rol_id === 1" class="px-4 py-2 border">
            <Link :href="route('citas.edit', appointment.id)">
              <i class="fas fa-edit text-blue-600"></i>
            </Link>
          </td>
          <td v-if="$page.props.user.rol_id === 1" class="px-4 py-2 border">
            <a href="#" @click.prevent="destroy(appointment.id)">
              <i class="fas fa-trash-alt text-red-600"></i
            ></a>
          </td>
      </tr>
    </tbody>
  </table>
</template>
<script>
import { defineComponent } from "vue";
import { Head, Link } from "@inertiajs/inertia-vue3";
export default defineComponent({
  components: {
    Head,
    Link,
  },
  props: {
    appointments: Object,
  },
  methods: {
    destroy(id) {
      if (confirm("¿Desea Eliminar?")) {
        this.$inertia.delete(this.route("citas.destroy", id));
      }
    },
  },
});
</script>

<style scoped>
@media (min-width: 768px) {
  .md-table-cell {
    display: table-cell;
  }
}
</style>
