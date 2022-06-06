<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import InputText from "primevue/inputtext";

const props = defineProps({
    query: Object,
    routeTo: String,
});

const form = useForm({
    query: {
        email: props.query?.email,
        username: props.query?.username,
    },
    page: 1,
});

const submit = () => {
    form.page = 1; // para que vuelva a la primer hoja si filtras
    form.get(props.routeTo, {
        preserveState: false,
        preserveScroll: false,
        onStart: () => {},
        onFinish: () => {},
        onSuccess: () => {},
    });
};
</script>

<template>
    <form @submit.prevent="submit()">
        <div class="grid grid-cols-3 md:grid-cols-3">
            <div class="">
                <div class="p-inputgroup">
                    <span class="p-inputgroup-addon">
                        <i class="pi pi-user"></i>
                    </span>
                    <InputText
                        disabled
                        placeholder="Username"
                        v-model="form.query.username"
                    ></InputText>
                </div>
            </div>

            <div class="">
                <div class="p-inputgroup">
                    <span class="p-inputgroup-addon">
                        <i class="pi pi-envelope"></i>
                    </span>
                    <InputText
                        placeholder="Email"
                        v-model="form.query.email"
                    ></InputText>
                </div>
            </div>
            <div class="flex">
                <div class="p-inputgroup">
                    <button
                        class="bg-indigo-400 hover:bg-indigo-500 text-white font-bold py-2 px-4 rounded w-full"
                        type="submit"
                    >
                        Submit
                    </button>
                </div>
            </div>
        </div>
    </form>
</template>
