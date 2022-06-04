<script setup>
import { ref, reactive, computed } from "vue";
import OrganizationChart from "primevue/organizationchart";
import TreeSelect from "primevue/treeselect";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import JetNavLink from "@/Jetstream/NavLink.vue";
import DataTable from "primevue/datatable";
import Column from "primevue/column";
import InputText from "primevue/inputtext";
import { FilterMatchMode, FilterOperator } from "primevue/api";

const toast = useToast();

const props = defineProps({
    locations: Array,
});

const filters = ref({
    global: { value: null, matchMode: FilterMatchMode.CONTAINS },
});
</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Locations
    </h2>

    <Toast />

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <span v-for="location in props.locations" :key="location.id">
                    <jet-nav-link
                        class="dark:text-white"
                        :href="route('admin.locations', location.id)"
                        :active="
                            route().current('admin.locations', location.id)
                        "
                    >
                        {{ location.name }}
                    </jet-nav-link>
                    <br />
                </span>
                <div v-if="props.locations.length == 1" class="">
                    <DataTable
                        :rows="10"
                        :paginator="true"
                        data-key="id"
                        paginator-template="FirstPageLink PrevPageLink PageLinks NextPageLink LastPageLink CurrentPageReport RowsPerPageDropdown"
                        :rows-per-page-options="[10, 25, 50]"
                        current-page-report-template="Showing {first} to {last} of {totalRecords} entries"
                        :value="props.locations[0].childs"
                        v-model:filters="filters"
                    >
                        <template #header>
                            <div class="text-right">
                                <div class="p-input-icon-left">
                                    <i class="pi pi-search"></i>
                                    <InputText
                                        v-model="filters['global'].value"
                                        placeholder="Global Search"
                                        size="50"
                                    />
                                </div>
                            </div>
                        </template>
                        <Column field="id" header="id"></Column>
                        <Column
                            field="name"
                            header="name"
                            :sortable="true"
                        ></Column>
                        <Column field="type_id" header="type_id"></Column>
                        <Column header="actions">
                            <template #body="data">
                                <jet-nav-link
                                    class="dark:text-white"
                                    :href="
                                        route('admin.locations', data.data.id)
                                    "
                                    :active="
                                        route().current(
                                            'admin.locations',
                                            data.data.id
                                        )
                                    "
                                >
                                    Go
                                </jet-nav-link>
                            </template>
                        </Column>
                    </DataTable>
                </div>
            </div>
        </div>
    </div>
</template>
<style>
.department-cfo {
    background-color: #7247bc !important;
    color: #ffffff !important;
    border-radius: 25px;
}

.department-coo {
    background-color: #a534b6 !important;
    color: #ffffff !important;
    border-radius: 25px;
}

.department-cto {
    background-color: #e9286f !important;
    color: #ffffff !important;
    border-radius: 25px;
}
</style>
