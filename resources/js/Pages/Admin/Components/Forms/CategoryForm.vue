<!--
<script setup>
import { ref, reactive, computed } from "vue";

const props = defineProps({
    category: Object,
});

const data = reactive({
    category: props,
});
</script>
-->
<template>
    <div class="grid p-fluid">
        <div class="col-12 md:col-4">
            <form @submit.prevent="submit()">
                <div
                    v-if="category.mode != 'delete-category'"
                    class="p-inputgroup mb-2"
                >
                    <span class="p-inputgroup-addon">
                        <i class="pi pi-user"></i>
                    </span>
                    <InputText v-model="form.name" placeholder="Name" />
                </div>
                <div v-else>Delete, no undo!!!</div>
                <div class="p-inputgroup">
                    <button
                        type="submit"
                        class="bg-indigo-400 text-white h-10 inline-flex items-center justify-center px-4 font-bold border rounded-full focus:outline-none"
                    >
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>
</template>
<script>
import Button from "primevue/button";
import InputText from "primevue/inputtext";
import { useForm } from "@inertiajs/inertia-vue3";
export default {
    props: {
        category: Object,
    },
    components: {
        Button,
        InputText,
    },
    data() {
        return {
            form: useForm({
                name: "",
                id: "",
                parent_id: "",
            }),
        };
    },
    watch: {
        category(cat) {
            if (cat.mode == "add-parent") {
                this.form.name = "";
                this.form.id = "";
                this.form.parent_id = "";
            }
            if (cat.mode == "add-child") {
                this.form.name = "";
                this.form.id = "";
                this.form.parent_id = cat.id;
            }
            if (cat.mode == "edit-category") {
                this.form.name = cat.name;
                this.form.id = cat.id;
                this.form.parent_id = cat.parent_id;
            }
        },
    },
    methods: {
        submit() {
            console.log(this.category.mode);
            switch (this.category.mode) {
                case "add-parent":
                case "add-child":
                    this.form.post(this.route("admin.categories.store"), {
                        preserveState: false,
                        preserveScroll: false,
                        onStart: () => {},
                        onFinish: () => {},
                        onSuccess: () => {},
                    });
                    break;
                case "edit-category":
                    this.form.put(
                        this.route("admin.categories.update", this.category.id),
                        {
                            preserveState: false,
                            preserveScroll: false,
                            onStart: () => {},
                            onFinish: () => {},
                            onSuccess: () => {},
                        }
                    );
                    break;
                case "delete-category":
                    this.form.delete(
                        this.route("admin.categories.delete", this.category.id),
                        {
                            preserveState: false,
                            preserveScroll: false,
                            onStart: () => {},
                            onFinish: () => {},
                            onSuccess: () => {},
                        }
                    );
                    break;
            }
        },
    },
};
</script>
