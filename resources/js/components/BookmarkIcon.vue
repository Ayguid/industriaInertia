<template>
    <div @click="bookMarkEntity">
        <div v-if="!bookmarked">
            <button>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-indigo-400 dark:text-white"
                    fill="none"
                    viewBox="0 0 24 24"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        stroke-linecap="round"
                        stroke-linejoin="round"
                        d="M5 5a2 2 0 012-2h10a2 2 0 012 2v16l-7-3.5L5 21V5z"
                    />
                </svg>
            </button>
        </div>
        <div v-else>
            <button>
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    class="h-6 w-6 text-indigo-400 dark:text-white"
                    viewBox="0 0 20 20"
                    fill="currentColor"
                >
                    <path
                        d="M5 4a2 2 0 012-2h6a2 2 0 012 2v14l-5-2.5L5 18V4z"
                    />
                </svg>
            </button>
        </div>
    </div>
</template>
<script>
//import Welcome from '@/Jetstream/Welcome.vue'
export default {
    //props: ['posts'],
    props: {
        bookmarked: Boolean,
        entityId: [Number, String],
    },
    components: {
        //Welcome,
    },
    data() {
        return {};
    },
    methods: {
        bookMarkEntity() {
            this.$inertia
                .form(
                    {},
                    {
                        resetOnSuccess: true,
                    }
                )
                .post(route("bookmarkEntity", this.entityId), {
                    preserveScroll: true,
                });
        },
    },
    mounted() {},
};
</script>
