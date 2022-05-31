<template>
    <AppLayout title="Category">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
            >
                Category
            </h2>
        </template>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="bg-gray overflow-hidden shadow-xl sm:rounded-lg">
                    <CategoryPill
                        v-if="category.grand_parent"
                        :category="category.grand_parent"
                    />
                </div>
                {{ category.name }}

                Father--<Link
                    v-for="(cat, i) in category.childs"
                    class="bg-indigo-400 hover:bg-indigo-200 text-white font-bold py-2 px-4 rounded-full mr-2"
                    :key="i"
                    :href="route('categoryShow', cat.id)"
                    method="get"
                    as="button"
                    type="button"
                    >{{ cat.name }}</Link
                >
            </div>
        </div>
    </AppLayout>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import { Link } from "@inertiajs/inertia-vue3";
import CategoryPill from "@/Components/CategoryPill";
export default {
    props: {
        category: Object,
    },
    components: {
        AppLayout,
        Link,
        CategoryPill,
    },
};
</script>
