<!--
<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
//import home from "@/components/home.vue";
import PostCard from "@/Components/PostCard";
import InfiniteScroll from "@/Components/InfiniteScroll";
import { ref, reactive, computed, watch } from "vue";
//import { useRemember } from "@inertiajs/inertia-vue3";

const props = defineProps({
    posts: Object,
});
const dashBoardPosts = ref(props.posts); //asi se acuerda en el history change de los posts

const loadMorePosts = () => {
    console.log(dashBoardPosts.value.next_page_url);
    if (!dashBoardPosts.value.next_page_url) {
        return Promise.resolve();
    }
    return axios.get(dashBoardPosts.value.next_page_url).then((response) => {
        console.log(response);
        dashBoardPosts.value = {
            ...response.data,
            data: [...dashBoardPosts.value.data, ...response.data.data],
        };
    });
};
</script>
-->
<template>
    <div>
        <Head>
            <title>Dashboard</title>
            <meta name="description" content="Your page description" />
        </Head>
        <h2
            class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
        >
            Dashboard
        </h2>

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <!--
                    <home />
                    -->
                    <div
                        class="p-6 sm:px-20 bg-white border-b border-gray-200 rounded-lg"
                    >
                        <div class="text-2xl">
                            Welcome to your Aarbor application!
                        </div>

                        <div class="mt-6 text-gray-500">
                            Lorem ipsum dolor sit amet consectetur, adipisicing
                            elit. Perspiciatis molestias necessitatibus facere
                            perferendis deleniti nam quidem laudantium, ut id,
                            est ratione officiis alias ducimus sapiente minima
                            facilis. Veritatis, quam placeat!
                        </div>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-2">
                        <div class="p-2">
                            <div class="flex items-center">
                                <svg
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    stroke-width="2"
                                    viewBox="0 0 24 24"
                                    class="w-8 h-8 text-gray-400"
                                >
                                    <path
                                        d="M3 9a2 2 0 012-2h.93a2 2 0 001.664-.89l.812-1.22A2 2 0 0110.07 4h3.86a2 2 0 011.664.89l.812 1.22A2 2 0 0018.07 7H19a2 2 0 012 2v9a2 2 0 01-2 2H5a2 2 0 01-2-2V9z"
                                    />
                                    <path
                                        d="M15 13a3 3 0 11-6 0 3 3 0 016 0z"
                                    />
                                </svg>
                                <div
                                    class="ml-4 text-lg text-gray-600 leading-7 font-semibold"
                                >
                                    asdasdasdasdasd 2
                                </div>
                            </div>
                        </div>

                        <div class="">
                            <div class="">
                                <PostFeed :posts="posts" />
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import PostFeed from "@/Components/PostFeed";
export default {
    // Using the shorthand

    props: {
        posts: Object,
    },
    components: {
        PostFeed,
    },
    data() {
        return {};
    },
    watch: {},
    computed: {},
    methods: {},
};
</script>
