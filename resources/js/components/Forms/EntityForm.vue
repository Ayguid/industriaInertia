<script setup>
// import the component
import Treeselect from "vue3-treeselect";
// import the styles
import "vue3-treeselect/dist/vue3-treeselect.css";
//
import EntityDetailsPartial from "@/Components/Forms/Partials/EntityDetailsPartial.vue";
import EntityExtraInfoPartial from "@/Components/Forms/Partials/EntityExtraInfoPartial.vue";
import EntityLocationPartial from "@/Components/Forms/Partials/EntityLocationPartial.vue";
//
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
//
import { useForm } from "@inertiajs/inertia-vue3";

import JetValidationErrors from "@/Jetstream/ValidationErrors.vue";
import { computed } from "vue";

const props = defineProps({
    entity: Object,
    edit: Boolean,
    categories: Array,
});

/*
    id: null,
    name: "",
    email: "",
    username: "",
    description: "",
    phone: "",
    cellphone: "",
    userOwnsEntity: null,
    country_id: "",
    state_id: "",
    city_id: "",
    categories: [],
    */
const form = useForm("CreateEntity", {
    details: {
        name: props.entity?.name || "",
        username: props.entity?.username || "",
        email: props.entity?.email || "",
        website: props.entity?.website || "",
        description: props.entity?.description || "",
    },
    extraInfo: {
        phone: props.entity?.phone || "",
        phone_alt: props.entity?.phone_alt || "",
        cuit: props.entity?.cuit || "",
        cuil: props.entity?.cuil || "",
        founded_date: props.entity?.founded_date || "",
        employee_count: props.entity?.employee_count || "",
    },
    location: {
        country: props.entity?.country || "",
        state: props.entity?.state || "",
        city: props.entity?.city || "",
        street: props.entity?.street || "",
        street_number: props.entity?.street_number || "",
        apartment: props.entity?.apartment || "",
        apartment_number: props.entity?.apartment_number || "",
        postal_code: props.entity?.postal_code || "",
    },
    categories: props.entity?.categories || [],
});

const normalizer = (node) => {
    return {
        label: node.name,
    };
};
</script>
<template>
    <form class="w-full">
        <div class="">
            <Accordion :activeIndex="0">
                <AccordionTab header="Details">
                    <EntityDetailsPartial v-model="form.details" />
                </AccordionTab>
                <AccordionTab header="Xtra-Info">
                    <EntityExtraInfoPartial v-model="form.extraInfo" />
                </AccordionTab>
                <AccordionTab header="Location">
                    <EntityLocationPartial v-model="form.location" />
                </AccordionTab>
                <AccordionTab header="Categories">
                    <div
                        class="grid lg:grid-cols-2 md:grid-cols-2 sm:grid-cols-1 gap-4 mb-2"
                    >
                        <treeselect
                            v-for="(category, index) in props.categories"
                            :key="index"
                            :placeholder="category.name"
                            :multiple="true"
                            :options="category.children"
                            :normalizer="normalizer"
                            v-model="form.categories[index]"
                        />
                    </div>
                </AccordionTab>
            </Accordion>
        </div>
    </form>
    <pre>{{ form }}</pre>
</template>
