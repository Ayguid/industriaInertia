<template>
    <div class="flex p-4 rounded-lg bg-white dark:bg-gray-600">
        <img
            :src="$page.props.user.profile_photo_url"
            :alt="$page.props.user.name"
            class="flex-shrink-0 w-12 h-12 rounded-full"
        />

        <form @submit.prevent="submit()" class="flex-1 ml-4">
            <div class="z-50 relative">
                <!--
                <QuillEditor
                    theme="snow"
                    v-model:content="form.content"
                    contentType="html"
                    :modules="modules"
                    :toolbar="toolbar"
                />
                -->
                <QuillEditor
                    theme="bubble"
                    contentType="html"
                    v-model:content="form.content"
                    :options="options"
                />
            </div>

            <!--
            <textarea
                ref="text-area"
                @input="resizeTextarea"
                v-model="form.content"
                name="content"
                id=""
                rows="2"
                class="focus:ring-transparent border-none p-2 resize-none w-full text-lg"
                placeholder="Whats up?"
                label="Post content"
            ></textarea>
            -->
            <jet-validation-errors class="mb-4" />

            <div
                v-if="media.length"
                class="grid gap-2"
                :class="{ 'grid-cols-2': media.length > 1 }"
            >
                <div
                    v-for="(m, index) in media"
                    :key="index"
                    class="relative flex flex-col items-center justify-center"
                >
                    <button
                        type="button"
                        @click="removeMedia(index, m)"
                        class="m-1 absolute top-0 p-2 left-0 text-white bg-black bg-opacity-75 rounded-full cursor-pointer hover:bg-opacity-100"
                    >
                        <svg
                            xmlns="http://www.w3.org/2000/svg"
                            width="16"
                            height="16"
                            fill="currentColor"
                            class="bi bi-trash3"
                            viewBox="0 0 16 16"
                        >
                            <path
                                d="M6.5 1h3a.5.5 0 0 1 .5.5v1H6v-1a.5.5 0 0 1 .5-.5ZM11 2.5v-1A1.5 1.5 0 0 0 9.5 0h-3A1.5 1.5 0 0 0 5 1.5v1H2.506a.58.58 0 0 0-.01 0H1.5a.5.5 0 0 0 0 1h.538l.853 10.66A2 2 0 0 0 4.885 16h6.23a2 2 0 0 0 1.994-1.84l.853-10.66h.538a.5.5 0 0 0 0-1h-.995a.59.59 0 0 0-.01 0H11Zm1.958 1-.846 10.58a1 1 0 0 1-.997.92h-6.23a1 1 0 0 1-.997-.92L3.042 3.5h9.916Zm-7.487 1a.5.5 0 0 1 .528.47l.5 8.5a.5.5 0 0 1-.998.06L5 5.03a.5.5 0 0 1 .47-.53Zm5.058 0a.5.5 0 0 1 .47.53l-.5 8.5a.5.5 0 1 1-.998-.06l.5-8.5a.5.5 0 0 1 .528-.47ZM8 4.5a.5.5 0 0 1 .5.5v8.5a.5.5 0 0 1-1 0V5a.5.5 0 0 1 .5-.5Z"
                            />
                        </svg>
                    </button>
                    <img
                        :src="m.url"
                        alt=""
                        class="rounded-xl object-cover h-48 w-full"
                    />
                    <div
                        v-if="m.loading"
                        class="absolute bg-black bg-opacity-75 text-sm rounded px-2 text-white"
                    >
                        Loading...
                    </div>
                </div>
            </div>

            <div class="flex justify-between pt-2 mt-2 border-t items-center">
                <file-input @input="uploadMedia" class="-ml-2"></file-input>
                <div class="flex items-center space-x-2">
                    <div
                        :class="
                            remainingChars < 0
                                ? 'text-red-600'
                                : 'text-gray-400'
                        "
                    >
                        {{ remainingChars }}
                    </div>

                    <button
                        :disabled="!canSubmit"
                        type="submit"
                        class="bg-indigo-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                    >
                        <div v-if="loading">
                            <svg
                                role="status"
                                class="mr-2 w-8 h-8 text-gray-200 animate-spin dark:text-gray-600 fill-blue-600"
                                viewBox="0 0 100 101"
                                fill="none"
                                xmlns="http://www.w3.org/2000/svg"
                            >
                                <path
                                    d="M100 50.5908C100 78.2051 77.6142 100.591 50 100.591C22.3858 100.591 0 78.2051 0 50.5908C0 22.9766 22.3858 0.59082 50 0.59082C77.6142 0.59082 100 22.9766 100 50.5908ZM9.08144 50.5908C9.08144 73.1895 27.4013 91.5094 50 91.5094C72.5987 91.5094 90.9186 73.1895 90.9186 50.5908C90.9186 27.9921 72.5987 9.67226 50 9.67226C27.4013 9.67226 9.08144 27.9921 9.08144 50.5908Z"
                                    fill="currentColor"
                                />
                                <path
                                    d="M93.9676 39.0409C96.393 38.4038 97.8624 35.9116 97.0079 33.5539C95.2932 28.8227 92.871 24.3692 89.8167 20.348C85.8452 15.1192 80.8826 10.7238 75.2124 7.41289C69.5422 4.10194 63.2754 1.94025 56.7698 1.05124C51.7666 0.367541 46.6976 0.446843 41.7345 1.27873C39.2613 1.69328 37.813 4.19778 38.4501 6.62326C39.0873 9.04874 41.5694 10.4717 44.0505 10.1071C47.8511 9.54855 51.7191 9.52689 55.5402 10.0491C60.8642 10.7766 65.9928 12.5457 70.6331 15.2552C75.2735 17.9648 79.3347 21.5619 82.5849 25.841C84.9175 28.9121 86.7997 32.2913 88.1811 35.8758C89.083 38.2158 91.5421 39.6781 93.9676 39.0409Z"
                                    fill="currentFill"
                                />
                            </svg>
                        </div>
                        Post
                    </button>
                </div>
            </div>
        </form>
    </div>
</template>
<script>
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import FileInput from "@/Components/Forms/FileInput";
import { useForm } from "@inertiajs/inertia-vue3";
import { QuillEditor } from "@vueup/vue-quill";
import "@vueup/vue-quill/dist/vue-quill.snow.css";
import "@vueup/vue-quill/dist/vue-quill.bubble.css";

export default {
    props: {
        entity: Object,
    },
    components: {
        JetValidationErrors,
        FileInput,
        QuillEditor,
    },
    data() {
        return {
            loading: false,
            form: useForm({
                entity_id: this.entity.id,
                content: "",
                media: [],
            }),
            options: {
                debug: "false",
                modules: {
                    toolbar: [
                        //[{ header: 1 }, { header: 2 }],
                        [{ size: ["small", false, "large"] }], //, "huge"
                        ["bold", "italic", "underline", "strike"],
                        [
                            "blockquote",
                            //"code-block"
                        ],
                        [
                            "link",
                            "video",
                            //"image"
                        ],
                        [{ align: [] }],
                        [{ color: [] }, { background: [] }],
                    ],
                },
                placeholder: "Compose an epic...",
                readOnly: false,
            },
            /*
            modules: {
                name: "blotFormatter",
                module: BlotFormatter,
            },*/
            media: [],
        };
    },
    methods: {
        submit() {
            console.log(this.form.content);
            //this.loading = true;
            //this.form.mediaIds = this.media.map((item) => item.id);

            this.form.post(this.route("posts.store"), {
                preserveState: false,
                preserveScroll: true,
                onStart: () => {},
                onFinish: () => {},
                onSuccess: () => {
                    this.form = {
                        content: "",
                    };
                },
            });
        },
        removeMedia(index, item) {
            this.media.splice(index, 1);
            //this.form.media.splice(index, 1);
        },
        resizeTextarea() {
            const textarea = this.$refs["text-area"];
            textarea.style.height = "initial";
            textarea.style.height = `${textarea.scrollHeight}px`;
        },
        uploadMedia(files) {
            console.log(files);
            this.form.media = files;
            this.media = [];
            Array.from(files).forEach((media) => {
                let reader = new FileReader();
                reader.readAsDataURL(media);
                reader.onload = (e) => {
                    //e.target.result
                    let item = {
                        url: e.target.result,
                        id: undefined,
                        loading: false,
                    };

                    //let formData = new FormData();
                    //formData.append("file", media);
                    this.media.push(item);
                    /*
                    axios
                        .post(this.route("media.store"), formData)
                        .then(({ data }) => {
                            //console.log(res)
                            item.id = data.id;
                            let x = this.media.find((m) => m.id == data.id);
                            x.loading = false;
                        })
                        .finally(() => {
                            //item.loading = false;
                        });
                        */
                };
            });
        },
    },
    computed: {
        remainingChars() {
            return 270 - this.form.content.length;
        },
        canSubmit() {
            return (
                this.form.content.length &&
                this.remainingChars >= 0 &&
                this.media.every((item) => !item.loading)
            );
        },
    },
    mounted() {},
};
</script>
<style>
button:disabled {
    opacity: 75%;
    cursor: not-allowed;
}
</style>
