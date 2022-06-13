<script setup>
import JetLabel from "@/Jetstream/Label.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetInputError from "@/Jetstream/InputError.vue";
import JetButton from "@/Jetstream/Button.vue";
import { ref } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";
const props = defineProps({
    user: Object,
});

const nameInput = ref(null);
const emailInput = ref(null);
const passwordInput = ref(null);
const passwordConfirmationInput = ref(null);

const formProfile = useForm({
    name: props.user.name,
    email: props.user.email,
});
const formPassword = useForm({
    password: "password",
    password_confirmation: "password",
});

const submit = (event) => {
    console.log(event);
};
</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        User
    </h2>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <form @submit.prevent="submit">
                <!--name-->
                <div class="w-full">
                    <JetLabel for="name" value="Name" />
                    <JetInput
                        id="name"
                        ref="nameInput"
                        v-model="formProfile.name"
                        type="text"
                        class="mt-1 block w-full"
                        autocomplete="name"
                    />
                    <JetInputError
                        :message="formProfile.errors.name"
                        class="mt-2"
                    />
                </div>
                <!--email-->
                <div class="w-full">
                    <JetLabel for="name" value="Email" />
                    <JetInput
                        id="email"
                        ref="emailInput"
                        v-model="formProfile.email"
                        type="email"
                        class="mt-1 block w-full"
                        autocomplete="email"
                    />
                    <JetInputError
                        :message="formProfile.errors.email"
                        class="mt-2"
                    />
                </div>
                <div class="w-full mt-1">
                    <JetButton
                        :class="{ 'opacity-25': formProfile.processing }"
                        :disabled="formProfile.processing"
                    >
                        Update details
                    </JetButton>
                </div>
            </form>
            <!--password-->
            <div class="w-full">
                <JetLabel for="password" value="Password" />
                <JetInput
                    id="password"
                    ref="passwordInput"
                    v-model="formPassword.password"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="password"
                />
                <JetInputError
                    :message="formPassword.errors.password"
                    class="mt-2"
                />
            </div>

            <!--password confirmation-->
            <div class="w-full">
                <JetLabel
                    for="password_confirmation"
                    value="Password confirmation"
                />
                <JetInput
                    id="password_confirmation"
                    ref="passwordConfirmationInput"
                    v-model="formPassword.password_confirmation"
                    type="text"
                    class="mt-1 block w-full"
                    autocomplete="password_confirmation"
                />
                <JetInputError
                    :message="formPassword.errors.password_confirmation"
                    class="mt-2"
                />
            </div>
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            {{ props.user }}{{ formProfile }}
        </div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=""></div>
    </div>
</template>
