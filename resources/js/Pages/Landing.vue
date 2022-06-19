<template>
    <Head>
        <title>Landing</title>
        <meta name="description" content="Your page description" />
    </Head>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
            >
                Aarvor -- Landing
            </h2>
            <!--Filter start-->
            <div
                class="grid lg:grid-cols-3 md:grid-cols-3 sm:grid-cols-1 gap-4"
            >
                <!--Categories Start :options="[category]"-->
                <div class="mb-2" v-for="(category, i) in categories" :key="i">
                    <treeselect
                        :placeholder="category.name"
                        :multiple="true"
                        :options="category.children"
                        :normalizer="normalizer"
                        v-model="selectedCats[i]"
                    />
                </div>
                <!--Categories End-->
                <!--Location Start-->
                <div class="mb-2">
                    <vSelect
                        class="dark:bg-white rounded text-gray-400"
                        @search="getLocations"
                        placeholder="Location"
                        :options="locationOptions"
                        label="name"
                        :loading="loadingLocations"
                        v-model="selectedLocations"
                        :multiple="true"
                        :filterable="false"
                    >
                        <template #option="option">
                            <span v-if="option.parent" class="text-gray-400"
                                >{{ abbreviate(option.parent.name) }}-
                            </span>
                            {{ option.name }}
                        </template>
                        <template #selected-option="option">
                            <span v-if="option.parent" class="text-gray-400"
                                >{{ abbreviate(option.parent.name) }}-
                            </span>
                            {{ option.name }}
                        </template>
                        <template #no-options="{ search, searching, loading }">
                            Search more specifically
                        </template>
                    </vSelect>
                </div>
                <!--Location End-->
            </div>
            <!--Filter end-->
            <!--Paginator Start-->
            <div class="mb-4 flex justify-center">
                <pagination :links="entities.links" />
            </div>
            <!--Paginator End-->

            <!--Entities Start-->
            <div
                class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4"
            >
                <div v-for="(entity, i) in entities.data" :key="i">
                    <EntityCard :entity="entity" />
                </div>
            </div>
            <!--Entities End-->
        </div>
    </div>
</template>
<script>
import EntityCard from "@/Components/EntityCard.vue";
import Pagination from "@/Components/Pagination.vue";
import vSelect from "vue-select";
import "vue-select/dist/vue-select.css";

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
        Treeselect,
        EntityCard,
        Pagination,
        vSelect,
    },
    data() {
        return {
            locationOptions: [],
            loadingLocations: false,
            normalizer(node) {
                return {
                    label: node.name,
                };
            },
            selectedCats: this.query_params?.categories
                ? JSON.parse(this.query_params?.categories)
                : [],
            selectedLocations: this.query_params?.locations
                ? JSON.parse(this.query_params?.locations)
                : [],
        };
    },
    computed: {},
    watch: {
        selectedCats: {
            //usamos un watcher para ver los cambios en el filtro, los eventos del tree select estan bugged
            handler(newValue, oldValue) {
                this.filterEntities();
            },
            deep: true,
        },
        selectedLocations: {
            //usamos un watcher para ver los cambios en el filtro, los eventos del tree select estan bugged
            handler(newValue, oldValue) {
                this.filterEntities();
            },
            deep: true,
        },
    },
    methods: {
        filterEntities() {
            this.$inertia.get(
                route("landing"),
                {
                    locations: JSON.stringify(this.selectedLocations),
                    categories: JSON.stringify(this.selectedCats),
                    page: 1,
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
        getLocations: _.debounce(async function (e) {
            //console.log(e);
            if (e.length < 2) return;
            //this.loading = true;
            this.loadingLocations = true;
            const res = await axios.get("/api/locations?query=" + e);
            this.locationOptions = res.data.data.map((item) => {
                //sacamos toda la data salvo id , name y parent.name
                return (({ id, name, parent }) => ({ id, name, parent }))(item);
            });
            this.loadingLocations = false;
            console.log(res.data.data);
        }, 500),
        abbreviate(string) {
            //return string.match(/\b([A-Z])/g).join("");
            var split_names = string.trim().split(" ");
            if (split_names.length > 1) {
                return split_names[0] + " " + split_names[1].charAt(0) + ".";
            }
            return split_names[0];
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
::placeholder {
  /*color: #333 !important;*/
}

</style>
