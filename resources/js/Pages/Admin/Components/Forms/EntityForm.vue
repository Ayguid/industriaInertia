<script setup>
import EntityDetailsPartial from "@/Pages/Admin/Components/Forms/Partials/EntityDetailsPartial.vue";
import EntityExtraInfoPartial from "@/Pages/Admin/Components/Forms/Partials/EntityExtraInfoPartial.vue";
import EntityLocationPartial from "@/Pages/Admin/Components/Forms/Partials/EntityLocationPartial.vue";
import EntityOwnerPartial from "@/Pages/Admin/Components/Forms/Partials/EntityOwnerPartial.vue";
import EntityCategoriesPartial from "@/Pages/Admin/Components/Forms/Partials/EntityCategoriesPartial.vue";
import JetButton from "@/Jetstream/Button.vue";
import Accordion from "primevue/accordion";
import AccordionTab from "primevue/accordiontab";
import JetInputError from "@/Jetstream/InputError.vue";
//import { reactive } from "vue";
import { useForm } from "@inertiajs/inertia-vue3";

const props = defineProps({
    entity: Object,
});

/*
    'created_by_user_id',
    'user_id',
    'name',
    'username',
    'email',
    'description',
    'cuit',
    'cuil',
    'founded_date',
    'employee_count',
    'country_id',
    'state_id',
    'city_id',
    'street',
    'street_number',
    'postal_code',
    'phone',
    'cellphone',
    'profile_photo_path',
    'background_photo_path'
*/

const form = useForm("CreateEntity", {
    // pasamos el key "CreateEntity" para que ande el remember en el history
    id: props.entity?.id || null,
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
    owner: {
        user: props.entity?.user || null,
        creator: props.entity?.created_by_user_id || null,
    },
    categories: props.entity?.categories || [],
});

const submit = (e) => {
    form.transform((data) => ({
        //...data,
        ...data.details,
        ...data.extraInfo,
        ...data.location,
        user_id: data.owner?.user?.id || null,
        created_by_user_id: data.owner?.creator?.id || null,
        country_id: data.location.country.id, //dejamos el id nomas
        state_id: data.location.state.id, //dejamos el id nomas
        city_id: data.location.city.id, //dejamos el id nomas
        categories: data.categories.map((a) => a.id), //dejamos los ids nomas
    })).post(route("admin.entities.store"), {
        preserveState: true,
        preserveScroll: false,
        onStart: () => {},
        onFinish: () => {},
        onSuccess: () => {},
    });
};
</script>

<template>
    <!--
        -->
    <form @submit.prevent="submit">
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
            <AccordionTab header="Owner">
                <EntityOwnerPartial v-model="form.owner" />
            </AccordionTab>
            <AccordionTab header="Categories">
                <EntityCategoriesPartial v-model="form.categories" />
            </AccordionTab>
        </Accordion>

        <span v-if="form.hasErrors">
            <JetInputError
                v-for="(error, i) in form.errors"
                :key="i"
                :message="error"
                class="mt-2"
            />
        </span>

        <!--

        -->
        <div class="mt-1">
            <JetButton
                :class="{ 'opacity-25': form.processing }"
                :disabled="form.processing"
            >
                Save
            </JetButton>
        </div>
    </form>
    {{ form }}
</template>
