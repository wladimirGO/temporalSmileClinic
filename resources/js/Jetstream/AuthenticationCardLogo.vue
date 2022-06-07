<template>
    <Link class="flex items-center" :href="'/'">
        <img class="h-28" src="/images/logo.png" alt="">
        <img class="h-16"  src="/images/letras.png" alt="">
    </Link>
</template>

<script>
    import { defineComponent } from 'vue'
    import { Link } from '@inertiajs/inertia-vue3';

    export default defineComponent({
        components: {
            Link,
        },
    })
</script>
