<template>
    <infinite-scroll :loadMore="loadMorePosts">
        <div class="min-h-full">
            <post-card
                v-for="(post, i) in feedPosts.data"
                :key="i"
                :post="post"
            />
        </div>
    </infinite-scroll>
</template>
<script>
import AppLayout from "@/Layouts/AppLayout.vue";
import PostCard from "@/Components/PostCard";
import InfiniteScroll from "@/Components/InfiniteScroll";
export default {
    props: {
        posts: Object,
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
};
</script>
