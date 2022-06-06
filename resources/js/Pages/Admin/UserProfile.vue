<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    user: Object,
});

const form = useForm({
    user: props.user,
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
        User
    </h2>

    <div class="py-4">
        <div
            class="grid grid-cols-1 md:grid-cols-2 max-w-7xl mx-auto sm:px-6 lg:px-8"
        >
            <div class="">
                <ul>
                    <li v-for="(item, key, index) in form.user">
                        <!--
                    {{ key }} - {{ item }}
                -->
                        <div class="w-full">
                            <label
                                class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                            >
                                {{ key }}
                            </label>
                            <input
                                class="appearance-none block w-full bg-gray-200 text-gray-700 border py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                                type="text"
                                :placeholder="key"
                                :disabled="isDisabled(key)"
                                v-model="form.user[key]"
                            />
                        </div>
                    </li>
                </ul>
            </div>
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">{{ form }}</div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class=""></div>
        </div>
    </div>
</template>
