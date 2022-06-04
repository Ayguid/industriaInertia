<template>
    <span class="mx-5 text-gray-500 dark:text-gray-300">
        <svg
            xmlns="http://www.w3.org/2000/svg"
            class="w-5 h-5"
            viewBox="0 0 20 20"
            fill="currentColor"
        >
            <path
                fill-rule="evenodd"
                d="M7.293 14.707a1 1 0 010-1.414L10.586 10 7.293 6.707a1 1 0 011.414-1.414l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414 0z"
                clip-rule="evenodd"
            />
        </svg>
    </span>
    <jet-nav-link
        class="dark:text-white"
        :href="route('category.show', who.id)"
        :active="route().current('category.show', who.id)"
    >
        {{ who.name }}
    </jet-nav-link>
    <!--

        <Link
        class="mr-2 inline"
        :href="route('categoryShow', who.id)"
        method="get"
    >
        {{ who.name }}
    </Link>
    -->

    <CategoryBreadCrumb v-if="who.grand_parent" :who="who.grand_parent" />
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
import JetNavLink from "@/Jetstream/NavLink.vue";
export default {
    props: {
        who: Object,
    },
    components: {
        Link,
        JetNavLink,
    },
};
</script>
