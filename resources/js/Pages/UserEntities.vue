<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
import EntityCard from "@/Components/EntityCard.vue";
import Pagination from "@/Components/Pagination.vue";
defineProps({
    user_entities: Object,
});
</script>

<template>
    <AppLayout title="User entities">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
            >
                Entities
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-12">
                    <jet-nav-link
                        class="dark:text-white"
                        :href="route('createEntity')"
                        :active="route().current('createEntity')"
                    >
                        Create entity
                    </jet-nav-link>
                </div>
                <div
                    class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8"
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
    </AppLayout>
</template>
