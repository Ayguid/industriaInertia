<template>
    <div class="flex items-center">
        <div class="flex w-full bg-white shadow rounded">
            <input
                class="w-full px-3 py-2 rounded focus:ring-indigo-400 z-0"
                id="search"
                autocomplete="on"
                type="text"
                name="search"
                placeholder="Buscar…"
                :value="search"
                @input="$emit('update:search', $event.target.value)"
            />
        </div>
        <button
            class="ml-3 text-sm text-gray-500 rounded-md p-2 bg-white"
            type="button"
            @click="$emit('delete:search')"
        >
            Reset
        </button>
    </div>
</template>

<script>
export default {
    components: {},
    props: {
        search: {
            type: String,
            default: "",
        },
    },
    emits: ["update:search", "delete:search"],
};
</script>
