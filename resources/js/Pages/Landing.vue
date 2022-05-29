<template>
    <AppLayout title="Dashboard">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Landing
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <!--Filter start-->
                <div class="grid grid-cols-4 gap-4">
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
                        <!-- @input="getEntities"  :options="category.children" no deja que elijan la categoria padre, tipo materiales, o proceso, a menos que dibujemos todas las cats en un casillero -->
                    </div>
                    {{ selectedCats }}
                </div>
                <!--Filter end-->
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";

// import the component
import Treeselect from "vue3-treeselect";
// import the styles
import "vue3-treeselect/dist/vue3-treeselect.css";
//import Welcome from '@/Jetstream/Welcome.vue';
export default {
    props: {
        categories: Array,
    },
    components: {
        AppLayout,
        Treeselect,
    },
    data() {
        return {
            normalizer(node) {
                return {
                    label: node.name,
                };
            },
            selectedCats: [],
        };
    },
};
</script>
<style>
textarea:focus,
.vue-treeselect--multi .vue-treeselect__input:focus {
    border: 0;
    box-shadow: none;
}
input[type="text"]:focus {
}
</style>
