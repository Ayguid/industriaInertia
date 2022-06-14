<script setup>
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButton from "@/Jetstream/Button.vue";
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
    countryOptions: [],
    stateOptions: [],
    cityOptions: [],
    countryLoading: false,
    stateLoading: false,
    cityLoading: false,
});

const form = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});

const fetchCountries = async (e) => {
    //console.log(e);
    state.countryLoading = true;
    const res = await axios.get("/api/fetchCountries");
    console.log(res);
    state.countryOptions = res.data;
    state.countryLoading = false;
    //state.stateOptions = [];
    //props.modelValue.state = null;
};

const fetchStates = async (e) => {
    //console.log(props.modelValue.country);
    state.stateLoading = true;
    const res = await axios.get(
        "/api/fetchStates?parent_id=" + props.modelValue.country.id
    );
    state.stateOptions = res.data;
    state.stateLoading = false;
    //state.cityOptions = [];
    //props.modelValue.city = null;
};
const fetchCities = async (e) => {
    state.cityLoading = true;
    const res = await axios.get(
        "/api/fetchCities?parent_id=" + props.modelValue.state.id
    );
    state.cityOptions = res.data;
    state.cityLoading = false;
};

onMounted(async () => {
    await fetchCountries();
});
</script>

<template>
    <div>
        <!-- @search="getLocations" :options="locationOptions" -->
        <JetLabel for="country" value="Country" />
        <vSelect
            id="country"
            class="dark:bg-indigo-500 rounded"
            :loading="state.countryLoading"
            @option:selected="fetchStates"
            :options="state.countryOptions"
            label="name"
            :multiple="false"
            :filterable="false"
            v-model="form.country"
        >
            <template #no-options="{ search, searching, loading }">
                Search more specifically
            </template>
        </vSelect>
    </div>
    <div>
        <JetLabel for="state" value="State" />
        <vSelect
            id="state"
            class="dark:bg-indigo-500 rounded"
            :loading="state.stateLoading"
            @option:selected="fetchCities"
            :options="state.stateOptions"
            label="name"
            :multiple="false"
            :filterable="false"
            v-model="form.state"
        >
            <template #no-options="{ search, searching, loading }">
                Search more specifically
            </template>
        </vSelect>
    </div>
    <div>
        <JetLabel for="city" value="City" />
        <vSelect
            id="city"
            class="dark:bg-indigo-500 rounded"
            :loading="state.cityLoading"
            :options="state.cityOptions"
            label="name"
            :multiple="false"
            :filterable="true"
            v-model="form.city"
        >
            <template #no-options="{ search, searching, loading }">
                Search more specifically
            </template>
        </vSelect>
    </div>
    <!--name-->
    <div class="w-full">
        <JetLabel for="street" value="Street" />
        <JetInput
            id="street"
            ref="streetInput"
            v-model="form.street"
            type="text"
            class="mt-1 block w-full"
            autocomplete="street"
        />
        <!--
            <JetInputError :message="form.errors.street" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="street_number" value="Street number" />
        <JetInput
            id="street_number"
            ref="street_numberInput"
            v-model="form.street_number"
            type="text"
            class="mt-1 block w-full"
            autocomplete="street_number"
        />
        <!--
            <JetInputError :message="form.errors.street_number" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="apartment" value="Apartment" />
        <JetInput
            id="apartment"
            ref="apartmentInput"
            v-model="form.apartment"
            type="text"
            class="mt-1 block w-full"
            autocomplete="apartment"
        />
        <!--
            <JetInputError :message="form.errors.street_number" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="apartment_number" value="Apartment number" />
        <JetInput
            id="apartment_number"
            ref="apartment_numberInput"
            v-model="form.apartment_number"
            type="text"
            class="mt-1 block w-full"
            autocomplete="apartment_number"
        />
        <!--
            <JetInputError :message="form.errors.street_number" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="postal_code" value="Postal code" />
        <JetInput
            id="postal_code"
            ref="postal_codeInput"
            v-model="form.postal_code"
            type="text"
            class="mt-1 block w-full"
            autocomplete="postal_code"
        />
        <!--
            <JetInputError :message="form.errors.postal_code" class="mt-2" />
        -->
    </div>
</template>
