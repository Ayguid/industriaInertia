<template>
    <AppLayout title="Landing">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
            >
                Aarbor -- Landing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!--Filter start-->
                <div
                    class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4"
                >
                    <div
                        class="mb-2"
                        v-for="(category, i) in categories"
                        :key="i"
                    >
                        <treeselect
                            :placeholder="category.name"
                            :multiple="true"
                            :options="[category]"
                            :normalizer="normalizer"
                            v-model="selectedCats[i]"
                        />
                    </div>
                </div>
                <div class="mb-4 flex justify-center">
                    <pagination :links="entities.links" />
                </div>
                <!--Filter end-->
                <div
                    class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4"
                >
                    <div v-for="(entity, i) in entities.data" :key="i">
                        <EntityCard
                            :entity="entity"
                            :bookmarkBtn="true"
                            :bookMarkEntity="bookMarkEntity"
                        />
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import EntityCard from "@/Components/EntityCard.vue";
import Pagination from "@/Components/Pagination.vue";

// import the component
import Treeselect from "vue3-treeselect";
// import the styles
import "vue3-treeselect/dist/vue3-treeselect.css";
//import Welcome from '@/Jetstream/Welcome.vue';
export default {
    props: {
        categories: Array,
        entities: Object,
        query_params: Object,
    },
    components: {
        AppLayout,
        Treeselect,
        EntityCard,
        Pagination,
    },
    data() {
        return {
            normalizer(node) {
                return {
                    label: node.name,
                };
            },
            selectedCats: this.query_params?.categories
                ? JSON.parse(this.query_params?.categories)
                : [],
        };
    },
    computed: {},
    watch: {
        selectedCats: {
            //usamos un watcher para ver los cambios en el filtro, los eventos del tree select estan bugged
            handler(newValue, oldValue) {
                this.entities.current_page = 1; // si el filtro cambia volvemos a la priemr hoja
                this.filterEntities();
            },
            deep: true,
        },
    },
    methods: {
        bookMarkEntity(id) {
            this.$inertia
                .form(
                    {},
                    {
                        resetOnSuccess: true,
                    }
                )
                .post(route("bookmarkEntity", id), {
                    preserveScroll: true,
                });
        },
        filterEntities() {
            //console.log(1, JSON.parse(JSON.stringify(this.selectedCats)));
            this.$inertia.get(
                route("landing"),
                {
                    categories: JSON.stringify(this.selectedCats),
                    page: this.entities.current_page,
                },
                {
                    replace: false,
                    preserveState: true,
                    preserveScroll: true,
                    only: [],
                    headers: {},
                    errorBag: null,
                    forceFormData: false,
                    onCancelToken: (cancelToken) => {},
                    onCancel: () => {},
                    onBefore: (visit) => {},
                    onStart: (visit) => {},
                    onProgress: (progress) => {},
                    onSuccess: (page) => {},
                    onError: (errors) => {},
                    onFinish: (visit) => {},
                }
            );
        },
    },
    mounted() {
        //let searchParams = new URLSearchParams(window.location.search);
        //console.log(searchParams.get("catIds"));
    },
};
</script>
<style>
textarea:focus,
.vue-treeselect--multi .vue-treeselect__input:focus {
    border: 0;
    box-shadow: none;
}
</style>
