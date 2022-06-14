<script setup>
import EntityForm from "@/Pages/Admin/Components/Forms/EntityForm.vue";

const props = defineProps({
    entity: Object,
});
</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Entity
    </h2>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <EntityForm :entity="props.entity" />
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8"></div>
    </div>
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <div class=""></div>
    </div>
</template>
