<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import EntityForm from "@/Components/Forms/EntityForm.vue";
//import Welcome from '@/Jetstream/Welcome.vue';
defineProps({
    edit: Boolean,
});
</script>

<template>
    <AppLayout title="Create Entity">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ edit ? "Edit" : "Create" }} Entity
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg p-4"
                >
                    <EntityForm />
                </div>
            </div>
        </div>
    </AppLayout>
</template>
