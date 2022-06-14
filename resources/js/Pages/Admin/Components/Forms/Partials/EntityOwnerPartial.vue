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
        type: Object,
        default: () => {},
    },
});

const state = reactive({
    users: [],
    creators: [],
    usersLoading: false,
    creatorsLoading: false,
});

const form = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const fetchUsers = _.debounce(async function (e) {
    //console.log(e);
    state.usersLoading = true;
    const res = await axios.get("/api/users?query=" + e);
    //console.log(res);
    state.users = res.data.data; //porque viene paginated
    state.usersLoading = false;
}, 500);
//
const fetchCreators = _.debounce(async function (e) {
    //console.log(e);
    state.creatorsLoading = true;
    const res = await axios.get("/api/users?query=" + e);
    //console.log(res);
    state.creators = res.data.data; //porque viene paginated
    state.creatorsLoading = false;
}, 500);

onMounted(async () => {
    //await fetchCountries();
});
</script>

<template>
    <div>
        <!-- @search="getLocations" :options="locationOptions" -->
        <JetLabel for="user" value="User" />
        <vSelect
            id="user"
            class="dark:bg-indigo-500 rounded"
            :loading="state.usersLoading"
            @search="fetchUsers"
            :options="state.users"
            label="email"
            :multiple="false"
            :filterable="false"
            v-model="form.user"
        >
            <template #no-options="{ search, searching, loading }">
                Search more specifically
            </template>
        </vSelect>
    </div>
    <div>
        <!-- @search="getLocations" :options="locationOptions" -->
        <JetLabel for="creator" value="Creator" />
        <vSelect
            id="user"
            class="dark:bg-indigo-500 rounded"
            :loading="state.creatorsLoading"
            @search="fetchCreators"
            :options="state.creators"
            label="email"
            :multiple="false"
            :filterable="false"
            v-model="form.creator"
        >
            <template #no-options="{ search, searching, loading }">
                Search more specifically
            </template>
        </vSelect>
    </div>
</template>
