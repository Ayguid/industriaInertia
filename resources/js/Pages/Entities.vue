<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import JetNavLink from "@/Jetstream/NavLink.vue";
</script>

<template>
    <AppLayout title="User entities">
        <template #header>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Entities
            </h2>
        </template>
        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div class="mb-12">
                    <jet-nav-link
                        :href="route('createEntity')"
                        :active="route().current('createEntity')"
                    >
                        Create entity
                    </jet-nav-link>
                </div>
                <div
                    class="bg-white overflow-hidden shadow-xl sm:rounded-lg grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 lg:gap-8"
                >
                    <!-- Entity card start -->
                    <div
                        v-for="(entity, i) in $page.props.user_entities"
                        class="max-w-sm bg-white rounded-lg border border-gray-200 shadow-md dark:bg-gray-800 dark:border-gray-700"
                    >
                        <a href="#">
                            <img
                                class="rounded-t-lg"
                                src="/docs/images/blog/image-1.jpg"
                                alt=""
                            />
                        </a>
                        <div class="p-5">
                            <a href="#">
                                <h5
                                    class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white"
                                >
                                    {{ entity.name }}
                                </h5>
                            </a>
                            <p
                                class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                            >
                                {{ entity.description }}
                            </p>
                            <p
                                class="mb-3 font-normal text-gray-700 dark:text-gray-400"
                            >
                                {{ entity.street }} {{ entity.street_number }}
                            </p>

                            <a
                                href="#"
                                class="inline-flex items-center py-2 px-3 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800"
                            >
                                Read more
                                <svg
                                    class="ml-2 -mr-1 w-4 h-4"
                                    fill="currentColor"
                                    viewBox="0 0 20 20"
                                    xmlns="http://www.w3.org/2000/svg"
                                >
                                    <path
                                        fill-rule="evenodd"
                                        d="M10.293 3.293a1 1 0 011.414 0l6 6a1 1 0 010 1.414l-6 6a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-4.293-4.293a1 1 0 010-1.414z"
                                        clip-rule="evenodd"
                                    ></path>
                                </svg>
                            </a>
                        </div>
                    </div>
                    <!-- Entity card end -->
                </div>
            </div>
        </div>
    </AppLayout>
</template>
