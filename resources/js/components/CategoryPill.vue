<template>
    <Link
        class="bg-indigo-200 hover:bg-indigo-100 text-white font-bold py-2 px-4 rounded-full mr-2 inline"
        :href="route('categoryShow', category.id)"
        method="get"
        as="button"
        type="button"
        >{{ category.name }} </Link
    >Son-->
    <span v-if="category.grand_parent">
        <CategoryPill :category="category.grand_parent" />
    </span>
</template>
<script>
//import CategoryPill from "@/Components/CategoryPill.vue";
import { Link } from "@inertiajs/inertia-vue3";
export default {
    props: {
        category: Object,
    },
    components: {
        Link,
    },
};
</script>
