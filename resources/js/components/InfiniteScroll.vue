<template>
    <slot></slot>
    <div v-if="loading" class="p-4 text-center text-gray-600">
        Loading More...
    </div>
</template>
<script>
//import axios from "axios";
import { debounce } from "lodash";
export default {
    //emits:['loadMore'],
    props: {
        loadMore: Function,
    },
    data() {
        return {
            loading: false,
        };
    },
    mounted() {
        const feed_container = document.getElementById("feed_container");
        feed_container.addEventListener("scroll", () => {
            if (
                feed_container.offsetHeight + feed_container.scrollTop >=
                    feed_container.scrollHeight &&
                !this.loading
            ) {
                this.loading = true;
                this.loadMore().finally(() => (this.loading = false));
                console.log("scrolled to bottom");
            }
        });

        /*
        window.addEventListener(
            "scroll",
            debounce((e) => {
                let pixelsFromBottom =
                    document.documentElement.offsetHeight -
                    document.documentElement.scrollTop -
                    window.innerHeight;
                if (pixelsFromBottom < 200 && !this.loading) {
                    this.loading = true;
                    this.loadMore().finally(() => (this.loading = false));
                }
            }, 100)
        );
        */
    },
};
</script>
