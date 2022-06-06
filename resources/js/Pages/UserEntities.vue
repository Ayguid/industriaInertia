<script>
import JetNavLink from "@/Jetstream/NavLink.vue";
import EntityCard from "@/Components/EntityCard.vue";
import Pagination from "@/Components/Pagination.vue";
export default {
    props: {
        user_entities: Object,
    },
    components: {
        JetNavLink,
        Pagination,
        EntityCard,
    },
};
</script>
<template>
    <Head>
        <title>User Entities</title>
        <meta name="description" content="Your page description" />
    </Head>

    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white inline"
            >
                User Entities
            </h2>

            <jet-nav-link
                class="dark:text-white"
                :href="route('entities.create')"
                :active="route().current('entities.create')"
            >
                Create entity
            </jet-nav-link>

            <div
                class="grid lg:grid-cols-4 md:grid-cols-2 sm:grid-cols-1 gap-4"
            >
                <!-- Entity card start -->
                <div v-for="(entity, i) in user_entities.data" class="">
                    <EntityCard :entity="entity" />
                </div>
                <!-- Entity card end -->
            </div>
            <pagination class="mt-6" :links="user_entities.links" />
        </div>
    </div>
</template>
