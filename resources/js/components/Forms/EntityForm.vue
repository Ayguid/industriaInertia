<script setup>
import { useForm } from "@inertiajs/inertia-vue3";
import JetAuthenticationCard from "@/Jetstream/AuthenticationCard.vue";
import JetAuthenticationCardLogo from "@/Jetstream/AuthenticationCardLogo.vue";
import JetButton from "@/Jetstream/Button.vue";
import JetInput from "@/Jetstream/Input.vue";
import JetCheckbox from "@/Jetstream/Checkbox.vue";
import JetLabel from "@/Jetstream/Label.vue";
import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import CategoryItem from "@/Components/Forms/CategoryItem.vue";
import { computed } from "vue";
const form = useForm({
    id: null,
    name: "",
    email: "",
    username: "",
    description: "",
    phone: "",
    cellphone: "",
    userOwnsEntity: null,
    catIds: [],
    country_id: "",
    state_id: "",
    city_id: "",
    categories: [],
});
const props = defineProps({
    edit: Boolean,
    categories: Array,
});

const data = {
    mainCatsLimit: 2, // 7 to test
    childLimit: 2,
};

const flatFormCategories = computed(() => {
    return form.categories;
});

const categories_list = computed(() => {
    let categoriesArranged;
    if (
        form.categories.filter((f) => !f.parent_id).length == data.mainCatsLimit
    ) {
        // main permited feelings
        var activeIds = form.categories.map((a) => a.id); //array con los ids de los feelings seleccionados en el form
        categoriesArranged = props.categories.filter(({ id }) =>
            activeIds.includes(id)
        ); // feelings con esos ids,,
    } else {
        //all main feelings
        categoriesArranged = props.categories;
    }
    return categoriesArranged;
    //return this.$store.state.baseFeelings
});
/*
const submit = () => {
    form.post(route("register"), {
        onFinish: () => form.reset("password", "password_confirmation"),
    });
};*/
const addToForm = (obj) => {
    //if(obj.parent_id)return
    //console.log("Master emit received");
    const found = form.categories.find((cat) => cat.id == obj.id);

    if (found) {
        //saca al padre y a sus hijos
        form.categories = form.categories.filter((cat) => cat.id != found.id);
        recursiveChildDelete(found);
    } else {
        form.categories.push(obj);
    }
};

const recursiveChildDelete = (obj) => {
    // encontrar a todos mis hijos y nietos y borrarlos
    for (var i = form.categories.length - 1; i >= 0; --i) {
        if (form.categories[i].parent_id == obj.id) {
            const x = form.categories[i];
            form.categories.splice(i, 1);
            if (x.parent_id) {
                recursiveChildDelete(x);
            }
        }
    }
};

const flat = (array) => {
    // aplanamos el array de cats en el form
    var result = [];
    array.forEach(function (a) {
        result.push(a);
        if (Array.isArray(a.children)) {
            result = result.concat(flat(a.children));
        }
    });
    return result;
};
</script>
<template>
    <div v-for="category in categories_list" :key="category.id">
        <CategoryItem
            :category="category"
            @selected_category="addToForm($event)"
            :list="flatFormCategories"
            :childLimit="data.childLimit"
        />
    </div>
    <pre>{{ form }}</pre>
    <!--
    <form class="w-full">
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0">
                <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-first-name"
                >
                    First Name
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white"
                    id="grid-first-name"
                    type="text"
                    placeholder="Jane"
                />
                <p class="text-red-500 text-xs italic">
                    Please fill out this field.
                </p>
            </div>
            <div class="w-full md:w-1/2 px-3">
                <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-last-name"
                >
                    Last Name
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-last-name"
                    type="text"
                    placeholder="Doe"
                />
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-6">
            <div class="w-full px-3">
                <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-password"
                >
                    Password
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-password"
                    type="password"
                    placeholder="******************"
                />
                <p class="text-gray-600 text-xs italic">
                    Make it as long and as crazy as you'd like
                </p>
            </div>
        </div>
        <div class="flex flex-wrap -mx-3 mb-2">
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-city"
                >
                    City
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-city"
                    type="text"
                    placeholder="Albuquerque"
                />
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-state"
                >
                    State
                </label>
                <div class="relative">
                    <select
                        class="block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                        id="grid-state"
                    >
                        <option>New Mexico</option>
                        <option>Missouri</option>
                        <option>Texas</option>
                    </select>
                    <div
                        class="pointer-events-none absolute inset-y-0 right-0 flex items-center px-2 text-gray-700"
                    >
                        <svg
                            class="fill-current h-4 w-4"
                            xmlns="http://www.w3.org/2000/svg"
                            viewBox="0 0 20 20"
                        >
                            <path
                                d="M9.293 12.95l.707.707L15.657 8l-1.414-1.414L10 10.828 5.757 6.586 4.343 8z"
                            />
                        </svg>
                    </div>
                </div>
            </div>
            <div class="w-full md:w-1/3 px-3 mb-6 md:mb-0">
                <label
                    class="block uppercase tracking-wide text-gray-700 text-xs font-bold mb-2"
                    for="grid-zip"
                >
                    Zip
                </label>
                <input
                    class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500"
                    id="grid-zip"
                    type="text"
                    placeholder="90210"
                />
            </div>
        </div>
    </form>
    -->
</template>
