<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Pagination from "@/Components/Pagination.vue";
const props = defineProps({
    users: Object,
});
</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Users
    </h2>

    <div class="py-4">
        <div class="mb-4 flex justify-center">
            <Pagination :links="props.users.links" />
        </div>
        <div
            class="max-w-7xl bg-white shadow-xl mx-auto sm:px-6 lg:px-8 sm:rounded-lg"
        >
            <div class="">
                <DataTable :value="props.users.data">
                    <Column field="id" header="id"></Column>
                    <Column field="name" header="name"></Column>
                    <Column field="email" header="email"></Column>
                </DataTable>
            </div>
        </div>
    </div>
</template>
