<template>
    <div
        class="p-4 bg-white rounded-lg border border-gray-200 dark:bg-gray-600 dark:border-gray-700"
    >
        <!--
        <img
            :src="post.user.profile_photo_url"
            :alt="post.user.name"
            class="flex-shrink-0 w-12 h-12 rounded-full"
        />
        <div class="ml-4">
            <div>
                <a :href="`${post.user.username}`" class="font-bold">{{
                    post.user.name
                }}</a>
                -
                <a
                    :href="`${post.user.username}`"
                    class="text-gray-500 text-sm"
                    >{{ `@${post.user.username}` }}</a
                >
            </div>
            -->
        <!--
      <p id="content" class="content" style="white-space: pre-line">
        {{ postContent }}
      </p>
      -->
        <span
            class="text-md leading-4 font-medium text-gray-800 dark:sm:text-white"
            style="white-space: break-spaces"
            v-html="post.content"
        ></span>
        <!--
                <div class="mb-4">{{ post.content }}</div>
                <p id="content" class="content"
                  v-html="convertToTag(post.content)">
                </p>
              -->

        <div
            v-if="post.media.length"
            class="grid gap-2"
            :class="{ 'grid-cols-2': post.media.length > 1 }"
        >
            <div
                v-for="(m, index) in post.media"
                :key="index"
                class="relative flex flex-col items-center justify-center"
            >
                <img
                    :src="m.full_url"
                    alt=""
                    class="object-cover w-full rounded-xl"
                />
            </div>
        </div>

        <div class="flex items-center">
            <!--los botones de inertia puede hacer reqs como un form  wow"-->
            <!--
                <Link
                class="inline-flex items-center rounded-full p-2 hover:blue-100 text-blue-500 focus:ring-transparent" 
                preserve-scroll
                preserve-state
                method="POST"
                as="button" 
                :href="`/posts/${postData.id}/like`">
                    <PostLikeIcon class="w-4 h-4" :name="postData.liked?'heart':'heart-outline'"></PostLikeIcon>
                </Link>
                -->
            <!--
                <button
                    @click="toggleLike()"
                    class="inline-flex items-center rounded-full p-2 hover:blue-100 text-blue-500 focus:ring-transparent"
                >
                    <PostLikeIcon
                        class="w-4 h-4"
                        :name="post.liked ? 'heart' : 'heart-outline'"
                    ></PostLikeIcon>
                </button>
-->
            <!--
                <div>{{ post.likes_count }}</div>

                <button class="ml-4" v-if="userCanEdit">
                    <EditIcon />
                </button>
            </div>
                -->
            <div v-if="post.entity_author">
                <Link
                    :href="route('entity.profile', post.entity_author.username)"
                    class="inline-flex items-center py-2 px-3 text-sm text-indigo-400 hover:text-indigo-600"
                >
                    {{ post.entity_author.username }}
                </Link>
            </div>
            <button @click="deletePost()" class="ml-4" v-if="userCanEdit">
                <svg
                    xmlns="http://www.w3.org/2000/svg"
                    width="24"
                    height="24"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="#000000"
                    stroke-width="2"
                    stroke-linecap="round"
                    stroke-linejoin="round"
                >
                    <polyline points="3 6 5 6 21 6"></polyline>
                    <path
                        d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                    ></path>
                    <line x1="10" y1="11" x2="10" y2="17"></line>
                    <line x1="14" y1="11" x2="14" y2="17"></line>
                </svg>
            </button>
        </div>
    </div>
</template>
<script>
import { Link } from "@inertiajs/inertia-vue3";
//import DeleteIcon from "@/Components/DeleteIcon";
export default {
    props: {
        post: Object,
    },
    data() {
        return {
            //post: this.postData,
        };
    },
    watch: {
        /*
        post(newData) {
            this.post = newData;
        },
        */
    },
    components: {
        Link,
        //EditIcon,
        //DeleteIcon,
    },
    computed: {
        /*
    postContent() {
      return this.postData.content;
    },
    */
        userCanEdit() {
            return this.$page.props?.user?.id == this.post.user_id;
        },
    },
    methods: {
        deletePost() {
            this.$inertia.delete(
                this.route("posts.destroy", this.post),
                { preserveState: true, preserveScroll: true },
                {}
            );
        },

        convertToTag(content) {
            var regExp =
                /^.*((youtu.be\/)|(v\/)|(\/u\/\w\/)|(embed\/)|(watch\?))\??v?=?([^#\&\?]*).*/;
            var match = content.match(regExp);
            if (match && match[7].length == 11) {
                var src = "https://www.youtube.com/embed/" + match[7];
                return (
                    '<div class="iframe_container"><iframe src=' +
                    src +
                    ' frameborder="0" allow="autoplay; encrypted-media" allowfullscreen></iframe></div>'
                );
            } else {
                var exp =
                    /(\b(https?|ftp|file):\/\/[-A-Z0-9+&@#\/%?=~_|!:,.;]*[-A-Z0-9+&@#\/%=~_|])/gi;
                var text1 = content.replace(
                    exp,
                    '<a class="text-gray-500 text-sm" target="_blank" href="$1">$1</a>'
                );
                var exp2 = /(^|[^\/])(www\.[\S]+(\b|$))/gim;
                return text1.replace(
                    exp2,
                    '$1<a class="text-gray-500 text-sm" target="_blank" href="http://$2">$2</a>'
                );
            }
        },
    },
};
</script>
<style scoped>
*:focus {
    outline: 0 !important;
}
</style>
