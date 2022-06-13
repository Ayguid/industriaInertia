<script setup>
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import { computed } from "vue";

const emit = defineEmits(["update:modelValue"]);
//
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
        <JetLabel for="name" value="Name" />
        <JetInput
            id="name"
            ref="nameInput"
            v-model="form.name"
            type="text"
            class="mt-1 block w-full"
            autocomplete="name"
        />
        <!--
            <JetInputError :message="form.errors.name" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="username" value="Username" />
        <JetInput
            id="username"
            ref="usernameInput"
            v-model="form.username"
            type="text"
            class="mt-1 block w-full"
            autocomplete="username"
        />
        <!--
            <JetInputError :message="form.errors.username" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="name" value="Email" />
        <JetInput
            id="email"
            ref="emailInput"
            v-model="form.email"
            type="email"
            class="mt-1 block w-full"
            autocomplete="email"
        />
        <!--
                <JetInputError :message="form.errors.email" class="mt-2" />

            -->
    </div>
    <div class="w-full">
        <JetLabel for="name" value="Description" />
        <JetInput
            id="description"
            ref="descriptionInput"
            v-model="form.description"
            type="text"
            class="mt-1 block w-full"
            autocomplete="description"
        />
        <!--
            <JetInputError :message="form.errors.description" class="mt-2" />
        -->
    </div>
    <div class="w-full">
        <JetLabel for="website" value="Website" />
        <JetInput
            id="website"
            ref="websiteInput"
            v-model="form.website"
            type="text"
            class="mt-1 block w-full"
            autocomplete="website"
        />
        <!--
            <JetInputError :message="form.errors.website" class="mt-2" />
        -->
    </div>
</template>
