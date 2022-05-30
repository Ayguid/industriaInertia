<script setup>
import AppLayout from "@/Layouts/AppLayout.vue";
import BookmarkIcon from "@/Components/BookmarkIcon";
//import Welcome from '@/Jetstream/Welcome.vue';
defineProps({
    entity: Object,
});
</script>

<template>
    <AppLayout :title="entity.username">
        <template #header>
            <h2
                class="font-semibold text-xl text-gray-800 leading-tight dark:text-white"
            >
                Entity
            </h2>
        </template>

        <div class="py-12">
            <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
                <div
                    class="bg-white shadow-xl sm:rounded-lg p-4 dark:bg-gray-800 dark:border-gray-700"
                >
                    <div
                        class="max-w-4xl mx-auto grid grid-cols-1 lg:max-w-5xl lg:gap-x-20 lg:grid-cols-2"
                    >
                        <div
                            class="relative p-3 col-start-1 row-start-1 flex flex-col rounded-lg bg-gradient-to-t from-black/75 via-black/0 sm:bg-none sm:row-start-2 sm:p-0 lg:row-start-1"
                        >
                            <h1
                                class="mt-1 text-lg font-semibold text-white sm:text-slate-900 md:text-2xl dark:sm:text-white"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 inline"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M5.121 17.804A13.937 13.937 0 0112 16c2.5 0 4.847.655 6.879 1.804M15 10a3 3 0 11-6 0 3 3 0 016 0zm6 2a9 9 0 11-18 0 9 9 0 0118 0z"
                                    />
                                </svg>
                                {{ entity.username }}
                            </h1>
                            <h4
                                class="mt-1 text-lg font-semibold text-white sm:text-slate-900 md:text-2xl dark:sm:text-white"
                            >
                                {{ entity.name }}
                            </h4>
                            <p
                                class="mt-1 text-md leading-4 font-medium text-white sm:text-slate-500 dark:sm:text-slate-400"
                            >
                                {{ entity.description }}
                            </p>
                            <p
                                class="mt-1 text-md leading-4 font-medium text-white sm:text-slate-500 dark:sm:text-slate-400"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 inline"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 8l7.89 5.26a2 2 0 002.22 0L21 8M5 19h14a2 2 0 002-2V7a2 2 0 00-2-2H5a2 2 0 00-2 2v10a2 2 0 002 2z"
                                    />
                                </svg>
                                {{ entity.email }}
                            </p>
                            <p
                                class="mt-1 text-md leading-4 font-medium text-white sm:text-slate-500 dark:sm:text-slate-400"
                            >
                                <svg
                                    xmlns="http://www.w3.org/2000/svg"
                                    class="h-6 w-6 inline"
                                    fill="none"
                                    viewBox="0 0 24 24"
                                    stroke="currentColor"
                                    stroke-width="2"
                                >
                                    <path
                                        stroke-linecap="round"
                                        stroke-linejoin="round"
                                        d="M3 5a2 2 0 012-2h3.28a1 1 0 01.948.684l1.498 4.493a1 1 0 01-.502 1.21l-2.257 1.13a11.042 11.042 0 005.516 5.516l1.13-2.257a1 1 0 011.21-.502l4.493 1.498a1 1 0 01.684.949V19a2 2 0 01-2 2h-1C9.716 21 3 14.284 3 6V5z"
                                    />
                                </svg>
                                {{ entity.phone }}
                            </p>
                        </div>
                        <div
                            class="grid gap-4 col-start-1 col-end-3 row-start-1 sm:mb-6 sm:grid-cols-4 lg:gap-6 lg:col-start-2 lg:row-end-6 lg:row-span-6 lg:mb-0"
                        >
                            <img
                                src="https://www.givenow.com.au/img/default-cover.png"
                                alt=""
                                class="w-full h-60 object-cover rounded-lg sm:h-52 sm:col-span-2 lg:col-span-full"
                                loading="lazy"
                            />
                            <img
                                src="https://www.givenow.com.au/img/default-cover.png"
                                alt=""
                                class="hidden w-full h-52 object-cover rounded-lg sm:block sm:col-span-2 md:col-span-1 lg:row-start-2 lg:col-span-2 lg:h-32"
                                loading="lazy"
                            />
                            <img
                                src="https://www.givenow.com.au/img/default-cover.png"
                                alt=""
                                class="hidden w-full h-52 object-cover rounded-lg md:block lg:row-start-2 lg:col-span-2 lg:h-32"
                                loading="lazy"
                            />
                        </div>
                        <dl
                            class="mt-4 text-xs font-medium flex items-center row-start-2 sm:mt-1 sm:row-start-3 md:mt-2.5 lg:row-start-2"
                        >
                            <dt class="sr-only">Reviews</dt>
                            <dd
                                class="text-indigo-600 flex items-center dark:text-indigo-400"
                            >
                                <BookmarkIcon :bookmarked="entity.bookmarked" />
                                <span
                                    >{{ entity.bookmarks_count }}
                                    <span class="text-slate-400 font-normal"
                                        >({{
                                            entity.bookmarks_count / 100
                                        }})</span
                                    ></span
                                >
                            </dd>
                            <dt class="sr-only">Location</dt>
                            <dd class="flex items-center dark:sm:text-white">
                                <svg
                                    width="2"
                                    height="2"
                                    aria-hidden="true"
                                    fill="currentColor"
                                    class="mx-3 text-slate-300"
                                >
                                    <circle cx="1" cy="1" r="1" />
                                </svg>
                                <svg
                                    width="24"
                                    height="24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="2"
                                    stroke-linecap="round"
                                    stroke-linejoin="round"
                                    class="mr-1 text-slate-400 dark:text-slate-500"
                                    aria-hidden="true"
                                >
                                    <path
                                        d="M18 11.034C18 14.897 12 19 12 19s-6-4.103-6-7.966C6 7.655 8.819 5 12 5s6 2.655 6 6.034Z"
                                    />
                                    <path
                                        d="M14 11a2 2 0 1 1-4 0 2 2 0 0 1 4 0Z"
                                    />
                                </svg>
                                Collingwood, Ontario
                            </dd>
                        </dl>
                        <div
                            class="mt-4 col-start-1 row-start-3 self-center sm:mt-0 sm:col-start-2 sm:row-start-2 sm:row-span-2 lg:mt-6 lg:col-start-1 lg:row-start-3 lg:row-end-4"
                        >
                            <!--
                            <button
                                type="button"
                                class="bg-indigo-600 text-white text-sm leading-6 font-medium py-2 px-3 rounded-lg"
                            >
                                Check availability
                            </button>
                            -->
                        </div>
                        <p
                            class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-4 lg:col-span-1 dark:text-slate-400"
                        >
                            Lorem, ipsum dolor sit amet consectetur adipisicing
                            elit. Veritatis, hic labore consequatur autem
                            voluptate nobis! Eaque accusantium, facere maiores
                            sit nihil quia asperiores velit dolores, blanditiis
                            nobis sequi ratione esse.
                        </p>
                        <div
                            class="mt-4 text-sm leading-6 col-start-1 sm:col-span-2 lg:mt-6 lg:row-start-5 lg:col-span-1 dark:text-slate-400"
                        >
                            <h6
                                class="mb-2 text-xl font-bold tracking-tight text-gray-900 dark:text-white"
                            >
                                Categories:
                            </h6>
                            <button
                                class="bg-indigo-400 hover:bg-indigo-600 text-white font-bold py-2 px-4 rounded-full mr-2"
                                v-for="(cat, i) in entity.categories"
                                :key="i"
                            >
                                {{ cat.name }}
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </AppLayout>
</template>
