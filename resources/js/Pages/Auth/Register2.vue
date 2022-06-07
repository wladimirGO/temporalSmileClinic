<template>

    <Head title="Register" />

    <jet-registro-container>
        <div class="step-line">
            <div class="step">1</div>
            <div class="line"></div>
            <div class="step step-on">2</div>
            <div class="line"></div>
            <div class="step">3</div>
        </div>
        <jet-validation-errors class="mb-4" />
        <p class="title-register">Crea tu Cuenta SmileClinic</p>
        
        <template #imagen>
            <jet-registro-container-imagen />
        </template>
    </jet-registro-container>
</template>

<script>
import { defineComponent } from 'vue'
import JetRegistroContainer from '@/Jetstream/RegistroContainer.vue'
import JetRegistroContainerImagen from '@/Jetstream/RegistroContainerImagen.vue'
import JetButton from '@/Jetstream/Button.vue'
import JetInput from '@/Jetstream/Input.vue'
import JetCheckbox from '@/Jetstream/Checkbox.vue'
import JetLabel from '@/Jetstream/Label.vue'
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue'
import { Head, Link } from '@inertiajs/inertia-vue3';

export default defineComponent({
    components: {
        Head,
        JetRegistroContainer,
        JetRegistroContainerImagen,
        JetButton,
        JetInput,
        JetCheckbox,
        JetLabel,
        JetValidationErrors,
        Link,
    },

    data() {
        return {
            form: this.$inertia.form({
                email: '',
                password: '',
                password_confirmation: '',
            })
        }
    },

    methods: {
        submit() {
            this.form.post(this.route('register'), {
                onFinish: () => this.form.reset('password', 'password_confirmation'),
            })
        }
    }
})
</script>
