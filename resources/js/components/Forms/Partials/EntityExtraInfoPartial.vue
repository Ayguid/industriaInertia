<script setup>
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import { computed } from "vue";
//import { reactive } from "vue";
//import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    //entity: Object,
    modelValue: {
        type: Object,
        default: () => {},
    },
});

const form = computed({
    get: () => props.modelValue,
    set: (value) => emit("update:modelValue", value),
});
</script>

<template>
    <!--name-->
    <div class="w-full">
        <JetLabel for="phone" value="Phone" />
        <JetInput
            id="phone"
            ref="phoneInput"
            v-model="form.phone"
            type="text"
            class="mt-1 block w-full"
            autocomplete="phone"
        />
        <!--
            <JetInputError :message="form.errors.phone" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="cellphone" value="Cellphone" />
        <JetInput
            id="cellphone"
            ref="cellphoneInput"
            v-model="form.phone_alt"
            type="text"
            class="mt-1 block w-full"
            autocomplete="cellphone"
        />
        <!--
            <JetInputError :message="form.errors.cellphone" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="cuil" value="CUIL" />
        <JetInput
            id="cuil"
            ref="cuilInput"
            v-model="form.cuil"
            type="text"
            class="mt-1 block w-full"
            autocomplete="cuil"
        />
        <!--
            <JetInputError :message="form.errors.cuil" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="cuit" value="CUIT" />
        <JetInput
            id="cuit"
            ref="cuitInput"
            v-model="form.cuit"
            type="text"
            class="mt-1 block w-full"
            autocomplete="cuit"
        />
        <!--
            <JetInputError :message="form.errors.cuit" class="mt-2" />
        -->
    </div>
    <!--email-->
    <div class="w-full">
        <JetLabel for="founded_date" value="Founded date" />
        <JetInput
            id="founded_date"
            ref="founded_dateInput"
            v-model="form.founded_date"
            type="text"
            class="mt-1 block w-full"
            autocomplete="founded_date"
        />
        <!--
            <JetInputError :message="form.errors.founded_date" class="mt-2" />
        -->
    </div>
    <!--description-->
    <div class="w-full">
        <JetLabel for="employee_count" value="Employee count" />
        <JetInput
            id="employee_count"
            ref="employee_countInput"
            v-model="form.employee_count"
            type="text"
            class="mt-1 block w-full"
            autocomplete="employee_count"
        />
        <!--
            <JetInputError :message="form.errors.employee_count" class="mt-2" />
        -->
    </div>
</template>
