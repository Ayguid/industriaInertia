<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Pagination from "@/Components/Pagination.vue";
const props = defineProps({
    entities: Object,
});
</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Entities
    </h2>

    <div class="py-4">
        <div class="mb-4 flex justify-center">
            <Pagination :links="props.entities.links" />
        </div>
        <div
            class="max-w-7xl bg-white shadow-xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg"
        >
            <div class="">
                <DataTable :value="props.entities.data" :scrollable="true">
                    <Column field="id" header="id"></Column>
                    <Column field="name" header="name"></Column>
                    <Column field="username" header="username"></Column>
                    <Column field="email" header="email"></Column>

                    <Column field="country.name" header="country"></Column>
                    <Column field="state.name" header="state"></Column>
                    <Column field="city.name" header="city"></Column>
                    <Column field="user.name" header="user"></Column>
                    <Column field="user.email" header="user email"></Column>
                </DataTable>
            </div>
        </div>
    </div>
</template>
