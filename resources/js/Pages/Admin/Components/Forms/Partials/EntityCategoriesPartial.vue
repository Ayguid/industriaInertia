<script setup>
import JetLabel from "@/Jetstream/Label.vue";
import JetInputError from "@/Jetstream/InputError.vue";

import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";
import { computed, onMounted, reactive } from "vue";

const emit = defineEmits(["update:modelValue"]);
//
const props = defineProps({
    //entity: Object,
    modelValue: {
        type: Array,
        default: () => [],
    },
});

const state = reactive({
    categories: [],
});

const form = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const fetchCategories = _.debounce(async function (e) {
    console.log(e);
    const res = await axios.get("/api/categories?query=" + e);
    //console.log(res);
    state.categories = res.data.data; //porque viene paginated
}, 500);

onMounted(async () => {
    //await fetchCountries();
});
</script>

<template>
    <div>
        <!-- @search="getLocations" :options="locationOptions" -->
        <JetLabel for="country" value="Categories" />
        <vSelect
            id="country"
            class="dark:bg-indigo-500 rounded"
            @search="fetchCategories"
            :options="state.categories"
            label="name"
            :multiple="true"
            :filterable="false"
            v-model="form"
        >
            <template #no-options="{ search, searching, loading }">
                Search more specifically
            </template>
        </vSelect>
    </div>
</template>
