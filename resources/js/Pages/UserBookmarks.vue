<!--
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import EntityCard from "@/Components/EntityCard.vue";
//import Welcome from '@/Jetstream/Welcome.vue';
defineProps({
    user_bookmarks: Object,
});
</script>
-->
<template>
    <Head>
        <title>User Bookmarks</title>
        <meta name="description" content="Your page description" />
    </Head>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
            >
                User Bookmarks
            </h2>
            <div
                class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4"
            >
                <div v-for="(entity, i) in user_bookmarks.data" :key="i">
                    <EntityCard :entity="entity" />
                </div>
            </div>
            <pagination class="mt-6" :links="user_bookmarks.links" />
        </div>
    </div>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import Pagination from "@/Components/Pagination.vue";
import EntityCard from "@/Components/EntityCard.vue";

//import Welcome from '@/Jetstream/Welcome.vue';
export default {
    layout: AppLayout,
    props: {
        user_bookmarks: Object,
    },
    components: {
        AppLayout,
        EntityCard,
        Pagination,
    },
    data() {
        return {};
    },
    computed: {},
    methods: {},
};
</script>
