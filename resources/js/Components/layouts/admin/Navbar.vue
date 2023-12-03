<script setup>
import { ThemeToggle } from '~Components/core'
import { router, usePage } from '@inertiajs/vue3'

const page = usePage()

const sekolah = page.props.sekolah

defineEmits(["toggleSidebar"])
</script>
<template>
    <nav class="fixed top-0 z-50 w-full bg-white border-b border-gray-200 dark:bg-gray-800 dark:border-gray-700">
        <div class="px-3 py-3 lg:px-5 lg:pl-3">
            <div class="flex items-center justify-between">
                <div class="flex items-center justify-start">
                    <button @click="$emit('toggleSidebar')" aria-controls="logo-sidebar" type="button"
                        class="inline-flex items-center p-2 text-sm text-gray-500 rounded-lg sm:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600">
                        <span class="sr-only">Open sidebar</span>
                        <font-awesome-icon icon="bars" size="2x"></font-awesome-icon>
                    </button>
                    <Link :href="route('admin.index')" class="flex ml-2 md:mr-24">
                        <img :src="sekolah.umum.logo" class="h-8 mr-3" :alt="sekolah.umum.nama" />
                        <span class="self-center text-xl font-semibold sm:text-2xl dark:text-white">
                            {{ sekolah.umum.nama }}
                        </span>
                    </Link>
                </div>
                <div class="flex items-center">
                    <ThemeToggle />
                    <Link class="text-gray-500 inline-flex items-center justify-center dark:text-gray-400 hover:bg-gray-100 w-10 h-10 dark:hover:bg-gray-700 focus:outline-none focus:ring-4 focus:ring-gray-200 dark:focus:ring-gray-700 rounded-lg text-sm p-2.5" href="/keluar" method="post" as="button">
                    <font-awesome-icon icon="right-from-bracket" size="lg"></font-awesome-icon>
                    </Link>
                </div>
            </div>
        </div>
    </nav>
</template>
