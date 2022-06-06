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

        <div class="py-4">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="">
                    <h2
                        class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
                    >
                        Dashboard
                    </h2>
                    <!--
                    <home />
                    -->
                    <!--
                    <Splitter
                        stateKey="splitterPanelKey"
                        stateStorage="local"
                        :layout="displayLayout"
                        style="height: 700px"
                    >
                        <SplitterPanel :minSize="10"> Panel 1 </SplitterPanel>
                        <SplitterPanel>
                            <PostFeed :posts="posts"
                        /></SplitterPanel>
                    </Splitter>
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
                        <div class="py-2">
                            <div class="flex items-center">
                                <div
                                    class="text-lg text-gray-600 leading-7 font-semibold"
                                >
                                    asdasdasdasdasd 2
                                </div>
                            </div>
                        </div>

                        <div class="py-2">
                            <div class="">
                                <PostFeed :posts="posts" height="70vh" />
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
import Splitter from "primevue/splitter";
import SplitterPanel from "primevue/splitterpanel";
export default {
    // Using the shorthand

    props: {
        posts: Object,
    },
    components: {
        PostFeed,
        Splitter,
        SplitterPanel,
    },
    data() {
        return {
            displayLayout: window.innerWidth > 960 ? "horizontal" : "vertical",
        };
    },
    watch: {},
    computed: {},
    methods: {
        onResize() {
            if (window.innerWidth > 960) {
                this.displayLayout = "horizontal";
            } else {
                this.displayLayout = "vertical";
            }
        },
    },
    created() {
        window.addEventListener("resize", this.onResize);
    },

    beforeDestroy() {
        window.removeEventListener("resize", this.onResize);
    },
};
</script>
