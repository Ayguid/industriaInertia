<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import Button from "primevue/button";

const props = defineProps({
    entity: Object,
});

const form = useForm({
    entity: props.entity,
});

const isDisabled = (key) => {
    switch (key) {
        case "id":
        case "created_at":
            return true;
        default:
            return false;
    }
};
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
                    v-for="(item, key, index) in form.entity"
                >
                    <!--{{ key }} - {{ item }}-->
                    <label
                        class="uppercase text-gray-700 text-xs font-bold py-3 px-4 flex items-center"
                    >
                        {{ key }}
                    </label>
                    <input
                        class="appearance-none block w-1/2 bg-gray-200 text-gray-700 border py-3 px-4 leading-tight focus:outline-none focus:bg-white"
                        type="text"
                        :placeholder="key"
                        :disabled="true"
                        v-model="form.entity[key]"
                    />
                    <Button icon="pi pi-pencil" class="p-button" @click="" />
                </div>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">{{ form }}</div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=""></div>
        </div>
    </div>
</template>
