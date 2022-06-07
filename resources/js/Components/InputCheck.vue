<template>
        <label  class="inline-flex flex justify-between items-center w-full p-3 hover:bg-gray-50 cursor-pointer">
            {{treatment.name}}
            <div>

                <input @click="sendEmitClick" class="text-blue-900 w-6 h-6 mr-2 focus:ring-grenn-300 focus:ring-opacity-25 border border-gray-300 rounded" type="checkbox" />
                <input v-model="count" min="1" class="border border-gray-300 w-20 rounded" type="number" name="count">
            </div>
        </label>
</template>

<script>
export default {
    data(){
        return{
            count: 1
        }
    },
    props:{
        treatment: Object
    },
    methods:{
        sendEmitClick(){
            let data = {
                treatment: this.treatment.id,
                count: this.count
            }
            this.$emit("sendEmitEvent",data);
        }
    },
    watch:{
        count(){
            if( this.count < 1){
                this.count =1;
            }
        }
    }
};
</script>