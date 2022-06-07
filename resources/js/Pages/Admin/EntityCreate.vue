<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import JetValidationErrors from '@/Jetstream/ValidationErrors.vue';

const props = defineProps({
    entity_model: Object // 
});

//usamos los keys del prop entity model, para armar el objeto que pasamos al formulario
const formObject = props.entity_model.reduce((accumulator, value) => {
  return {...accumulator, [value]: ''};
}, {});

const form = useForm(formObject);// aca pasamos el formObject
const submit = () => {
    console.log('submit')
    form.post(route('admin.entities.store'), {
        preserveState: false,
        preserveScroll: false,
        onStart: () => {},
        onFinish: () => {},
        onSuccess: () => {},
    });
}

//
</script>
<template>
    <h2>Create Entity</h2>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="submit()">
                <div class="">
                    <div
                        class="p-inputgroup"
                        v-for="(item, key, index) in props.entity_model" :key="index"
                    >   
                        <!--{{ key }} - {{ item }}-->
                        <label
                            class="uppercase text-gray-700 text-xs font-bold py-3 px-4 flex items-center"
                        >
                            {{ item }}
                        </label>
                        
                        <input
                            
                            class="appearance-none block w-1/2 bg-gray-200 text-gray-700 border py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                            type="text"
                            :placeholder="item"
                            v-model="form[item]"
                        />
                    </div>
                </div>
                    <button
                        type="submit"
                        class="bg-indigo-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                    >
                        Submit
                    </button>
            </form>
            <JetValidationErrors class="mb-4" />

            {{form}}

        </div>
    </div>
</template>
