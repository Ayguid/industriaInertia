<script setup>
import { ref, reactive, computed } from "vue";
import AdminLayout from "@/Layouts/AdminLayout.vue";
import OrganizationChart from "primevue/organizationchart";
import TreeSelect from "primevue/treeselect";
import { useToast } from "primevue/usetoast";
import Toast from "primevue/toast";
import TreeTable from "primevue/treetable";
import InputText from "primevue/inputtext";
import Column from "primevue/column";
import Button from "primevue/button";
import Modal from "@/Components/Modal.vue";
import CategoryForm from "@/Components/Forms/CategoryForm.vue";

const toast = useToast();

const props = defineProps({
    categories: Array,
});

const selectedCategory = ref({});
const isModalVisible = ref(false);
const filters = ref({});

const addKeytoallVals = (parent) => {
    //funcion recursiva para add key a cada categoria que el Organization chart y TreeTable piden tener!!!
    // add a parent link to a child structure
    //parent.styleClass = "department-cto";
    parent.label = parent.name;
    parent.key = parent.id;
    parent.data = {};
    parent.data.name = parent.name;
    parent.data.id = parent.id;
    parent.data.parent_id = parent.parent_id;
    //parent.icon = "pi pi-fw pi-cog";
    parent.children.forEach(function (d) {
        //parent.styleClass = "department-cfo";
        addKeytoallVals(d);
    });

    return parent;
};

const parsedCategories = computed(() => {
    props.categories.forEach((category) => {
        addKeytoallVals(category);
    });
    return props.categories;
});

const onNodeSelect = (node) => {
    toast.add({
        severity: "success",
        summary: "Category Clicked",
        detail: node.name,
        life: 3000,
    });
};

const selectCategory = (data, mode) => {
    data.mode = mode;
    selectedCategory.value = JSON.parse(JSON.stringify(data));
    isModalVisible.value = !isModalVisible.value;
    if (!isModalVisible) selectedCategory.value = {};
};
</script>

<template>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Categories
    </h2>

    <Toast />
    <Modal v-show="isModalVisible" @close="isModalVisible = false">
        <template v-slot:header>
            <span v-if="selectedCategory">{{ selectedCategory.mode }}</span>
        </template>

        <template v-slot:body>
            <CategoryForm :category="selectedCategory" />
        </template>

        <template v-slot:footer> This is a new modal footer. </template>
    </Modal>
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="p-inputgroup mb-4">
                <button
                    @click="selectCategory({}, 'add-parent')"
                    type="button"
                    class="bg-indigo-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                >
                    New Parent
                </button>
            </div>
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg mb-2">
                <TreeTable
                    :value="parsedCategories"
                    :filters="filters"
                    :resizableColumns="true"
                    columnResizeMode="fit"
                    showGridlines
                    sortMode="single"
                >
                    <template #header>
                        <div class="text-right">
                            <div class="p-input-icon-left">
                                <i class="pi pi-search"></i>
                                <InputText
                                    v-model="filters['global']"
                                    placeholder="Global Search"
                                    size="50"
                                />
                            </div>
                        </div>
                    </template>
                    <Column
                        field="name"
                        header="name"
                        :expander="true"
                        :sortable="true"
                    />

                    <Column field="id" header="id" :sortable="true" />
                    <Column field="parent_id" header="parent_id" />
                    <Column field="" header="actions">
                        <template #body="data">
                            <span class="mr-2">
                                <button
                                    @click="
                                        selectCategory(data.node, 'add-child')
                                    "
                                    type="button"
                                    class="bg-indigo-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z"
                                        />
                                    </svg>
                                </button>
                            </span>
                            <span class="mr-2">
                                <button
                                    @click="
                                        selectCategory(
                                            data.node,
                                            'edit-category'
                                        )
                                    "
                                    type="button"
                                    class="bg-amber-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M15.232 5.232l3.536 3.536m-2.036-5.036a2.5 2.5 0 113.536 3.536L6.5 21.036H3v-3.572L16.732 3.732z"
                                        />
                                    </svg>
                                </button>
                            </span>
                            <span class="mr-2">
                                <button
                                    type="button"
                                    class="bg-red-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                                >
                                    <svg
                                        xmlns="http://www.w3.org/2000/svg"
                                        class="h-6 w-6"
                                        fill="none"
                                        viewBox="0 0 24 24"
                                        stroke="currentColor"
                                        stroke-width="2"
                                    >
                                        <path
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                            d="M19 7l-.867 12.142A2 2 0 0116.138 21H7.862a2 2 0 01-1.995-1.858L5 7m5 4v6m4-6v6m1-10V4a1 1 0 00-1-1h-4a1 1 0 00-1 1v3M4 7h16"
                                        />
                                    </svg>
                                </button>
                            </span>
                        </template>
                    </Column>
                </TreeTable>
            </div>

            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <!--
                    <OrganizationChart
                        class="company"
                        @node-select="onNodeSelect"
                        selection-mode="single"
                        v-for="(category, i) in parsedCategories"
                        :value="category"
                        :key="i"
                        :collapsible="true"
                    >
                        <template #default="slotProps">
                            <span>{{ slotProps.node.name }}</span>
                        </template>
                    </OrganizationChart>
                    -->
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
