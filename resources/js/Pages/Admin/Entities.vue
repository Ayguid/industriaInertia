<script setup>
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import Pagination from "@/Components/Pagination.vue";
import FilterForm from "@/Pages/Admin/Components/Forms/FilterForm.vue";
import { Link } from "@inertiajs/inertia-vue3";

const props = defineProps({
    entities: Object,
    query: Object,
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
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <FilterForm
                :routeTo="route('admin.entities')"
                :query="props.query"
            />
        </div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="">
                <DataTable :value="props.entities.data" :scrollable="true">
                    <Column field="id" header="id"></Column>
                    <Column field="name" header="name"></Column>
                    <Column field="username" header="username">
                        <template #body="slotProps">
                            <Link
                                :href="
                                    route(
                                        'admin.entities.show',
                                        slotProps.data.id
                                    )
                                "
                                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-indigo-400 rounded-lg hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300"
                            >
                                {{ slotProps.data.username }}
                                <svg
                                    class="ml-2 -mr-1 w-4 h-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </Link>
                        </template>
                    </Column>
                    <Column field="email" header="email"></Column>

                    <Column field="country.name" header="country"></Column>
                    <Column field="state.name" header="state"></Column>
                    <Column field="city.name" header="city"></Column>
                    <Column field="user.username" header="user"></Column>
                    <Column field="user.email" header="user email"></Column>
                </DataTable>
            </div>
        </div>
    </div>
</template>
