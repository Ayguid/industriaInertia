<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";
import { ref, reactive, computed } from "vue";

const props = defineProps({
    entity: Object,
});

const form = useForm({
    //clonamos el objeto para que no se modifique el objeto original(prop.entity)
    entity: JSON.parse(JSON.stringify(props.entity))
});
const inputs = ref([])

//
const toggleDisabled = (index) =>{ //mejorar esto
    inputs.value[index].disabled = !inputs.value[index].disabled
}
//
/*
_.isEqual(obj1, obj2)
*/
const submit = ()=>{
    //vemos que propiedades cambiaron del objeto original(prop.entity), asi solo submiteamos lo que cambio
    const changedKeys = Object.keys(props.entity).filter( key => props.entity[key] !== form.entity[key]);
    let objToPost = {}; // posteamos un objeto con solo los cambios que hubo al objeto original(prop.entity)
    changedKeys.forEach(key=>{ objToPost[key] = form.entity[key] });
    //console.log( objToPost )
}

</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Entity
    </h2>
    
    <div class="py-4">
        <div
            class="grid grid-cols-1 md:grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8"
        >
  
            <div class="">
                <div
                    class="p-inputgroup"
                    v-for="(item, key, index) in form.entity" :key="index"
                >   
                    <!--{{ key }} - {{ item }}-->
                    <label
                        class="uppercase text-gray-700 text-xs font-bold py-3 px-4 flex items-center"
                    >
                        {{ key }}
                    </label>
                    
                    <input
                        :ref="el => { inputs[index] = el }"
                        class="appearance-none block w-1/2 bg-gray-200 text-gray-700 border py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                        type="text"
                        :placeholder="key"
                        :disabled="true"
                        v-model="form.entity[key]"
                    />
                    <Button v-if="key !== 'id'" icon="pi pi-pencil" class="p-button" @click="toggleDisabled(index)"/>
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!-- 
                {{props.entity}}{{ form }}
                -->
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <Button icon="pi pi-pencil" class="p-button" @click="submit"/>
            </div>
        </div>
    </div>
</template>
<style scoped>
input[type="text"]:disabled {
  background: #b9b2b2;
}
</style>