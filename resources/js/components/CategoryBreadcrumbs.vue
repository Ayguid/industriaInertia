<template>
    <div class="bg-gray-200 dark:bg-gray-800">
        <div
            class="container flex flex-row-reverse justify-end px-8 py-4 mx-auto overflow-y-auto whitespace-nowrap"
        >
            <CategoryBreadCrumb :who="category" />
        </div>
    </div>
</template>
<script>
import CategoryBreadCrumb from "@/Components/CategoryBreadCrumb";
export default {
    props: {
        category: Object,
    },
    components: {
        CategoryBreadCrumb,
    },
};
</script>
