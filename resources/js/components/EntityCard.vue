<template>
    <div
        class="bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
    >
        <img
            class="rounded-t-lg"
            src="https://www.givenow.com.au/img/default-cover.png"
            alt=""
        />

        <div class="p-5">
            <h5
                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
            >
                {{ entity.username }}
            </h5>
            <h5
                class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
            >
                {{ entity.name }}
            </h5>

            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ entity.description }}
            </p>
            <p class="mb-3 font-normal text-gray-700 dark:text-gray-400">
                {{ entity.street }}
                {{ entity.street_number }}
            </p>

            <div class="grid grid-cols-2 gap-4 mb-2">
                <Link
                    :href="route('entityProfile', entity.username)"
                    class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-indigo-400 rounded-lg hover:bg-indigo-600 focus:ring-4 focus:outline-none focus:ring-indigo-300"
                >
                    Go
                    <svg
                        class="ml-2 -mr-1 w-4 h-4"
                        fill="currentColor"
                        viewBox="0 0 20 20"
                        xmlns="http://www.w3.org/2000/svg"
                    >
                        <path
                            fill-rule="evenodd"
                            d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                            clip-rule="evenodd"
                        ></path>
                    </svg>
                </Link>
                <BookmarkIcon
                    v-if="bookmarkBtn"
                    :bookmarked="entity.bookmarked"
                    :entityId="entity.id"
                />
            </div>
            <div class="">
                <h6
                    class="text-xl font-bold tracking-tight text-gray-900 dark:text-white"
                >
                    Categories:
                </h6>
                <span
                    class="text-muted mr-2 mb-2 dark:text-white"
                    v-for="(cat, i) in entity.categories"
                    :key="i"
                >
                    {{ cat.name }}
                </span>
            </div>
            <div>
                <h6
                    class="text-xl font-bold tracking-tight text-gray-900 dark:text-white"
                >
                    Location:
                </h6>
                <div v-if="entity.country">
                    Country: {{ entity.country.name }}
                </div>
                <div v-if="entity.state">State: {{ entity.state.name }}</div>
                <div v-if="entity.city">City: {{ entity.city.name }}</div>
            </div>
        </div>
    </div>
</template>
<script>
import { defineComponent } from "vue";
import BookmarkIcon from "@/Components/BookmarkIcon";
import { Link } from "@inertiajs/inertia-vue3";

export default defineComponent({
    // type inference enabled
    props: {
        entity: Object,
        bookmarkBtn: Boolean,
    },
    components: {
        BookmarkIcon,
        Link,
    },
    data() {
        return {};
    },
    methods: {},
    mounted() {},
});
</script>
