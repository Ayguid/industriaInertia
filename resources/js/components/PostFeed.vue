<template>
    <div
        id="feed_container"
        class="overflow-y-scroll w-full rounded-lg"
        :style="'height: ' + height + ';'"
        scroll-region
    >
        <infinite-scroll :loadMore="loadMorePosts">
            <div v-for="(post, i) in feedPosts.data" :key="i" class="mb-2">
                <post-card :post="post" />
            </div>
        </infinite-scroll>
    </div>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PostCard from "@/Components/PostCard";
import InfiniteScroll from "@/Components/InfiniteScroll";
export default {
    props: {
        posts: Object,
        height: String,
    },
    components: {
        AppLayout,
        InfiniteScroll,
        PostCard,
    },
    data() {
        return {
            feedPosts: this.posts,
        };
    },
    remember: {
        data: ["feedPosts"],
        key: "Users/Create",
    },
    watch: {
        posts(newPosts) {
            this.feedPosts = newPosts;
        },
    },
    computed: {},
    methods: {
        loadMorePosts() {
            if (!this.feedPosts.next_page_url) {
                return Promise.resolve();
            }
            return axios.get(this.feedPosts.next_page_url).then((response) => {
                console.log(response);
                this.feedPosts = {
                    ...response.data,
                    data: [...this.feedPosts.data, ...response.data.data],
                };
            });
        },
    },
    mounted() {
        /*
        const feed_container = document.getElementById("feed_container");
        let top = localStorage.getItem("feed_container-scroll");
        if (top !== null) {
            feed_container.scrollTop = parseInt(top, 10);
        }

        window.addEventListener("beforeunload", () => {
            localStorage.setItem(
                "feed_container-scroll",
                feed_container.scrollTop
            );
        });
        */
    },
};
</script>
