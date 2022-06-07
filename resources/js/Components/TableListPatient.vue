<template>
  <table>
    <thead>
        <tr >
            <th class="border px-4 py-2" >DNI</th>
            <th class="border hidden md-table-cell  px-4 py-2">Nombre</th>
            <th class="border hidden md-table-cell px-4 py-2">Nro. Telefonico</th>
            <th class="border px-4 py-2" colspan="3"> Acciones</th>
        </tr>
    </thead>
    <tbody>

    <tr v-for="(patient) in patients" :key="patient.id">
      <td class="border px-4 py-2">
        {{ patient.dni }}
      </td>
      <td class="border hidden md-table-cell px-4 py-2">
        {{ patient.name }}
      </td>
      <td class="px-4  hidden md-table-cell border py-2">
        {{ patient.phone_number }}
      </td>
      <td class="px-4 py-2 border text-center">
        <Link :href="route('pacientes.show', patient.id)"> <i class="far fa-eye text-green-600"></i> </Link>
      </td>
      <td v-if="$page.props.user.rol_id===1" class="px-4 py-2 border">
        <Link  :href="route('pacientes.edit', patient.id)"> <i class="fas fa-edit text-blue-600"></i> </Link>
      </td>
      <td v-if="$page.props.user.rol_id===1" class="px-4 py-2 border">
        <a href="#" @click.prevent="destroy(patient.id)"> <i class="fas fa-trash-alt text-red-600"></i></a>
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
    patients: Object
  },
  methods:{
    destroy(id){
      if(confirm('¿Desea Eliminar?')){
        this.$inertia.delete(this.route('pacientes.destroy',id));
      }
    }
  }
});
</script>

<style scoped>
  @media (min-width: 768px) {
    .md-table-cell{
      display: table-cell;
    }
  }
</style>
