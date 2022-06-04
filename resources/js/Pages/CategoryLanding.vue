<template>
    <Head>
        <title>Category</title>
        <meta name="description" content="Your page description" />
    </Head>
    <h2
        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
    >
        Category: {{ category.name }}
    </h2>

    <!-- -->
    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
        <CategoryBreadcrumbs :category="category" />
    </div>
    <!-- -->
    <div class="py-4">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h4>CHILDREN</h4>
            <Link
                v-for="(cat, i) in category.childs"
                class="bg-indigo-400 hover:bg-indigo-200 text-white font-bold py-2 px-4 rounded-full mr-2"
                :key="i"
                :href="route('category.show', cat.id)"
                method="get"
                as="button"
                type="button"
                >{{ cat.name }}</Link
            >
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";

import CategoryBreadcrumbs from "@/Components/CategoryBreadcrumbs";
export default {
    props: {
        category: Object,
    },
    components: {
        Link,
        CategoryBreadcrumbs,
    },
    data() {
        return {};
    },
};
</script>
