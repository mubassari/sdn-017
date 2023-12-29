<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { AdminNavbar, AdminSidebar, Toast } from "~Components/layouts"
import { usePage, router } from "@inertiajs/vue3";
import CoreLayout from './CoreLayout.vue'

const sidebarIsOpen = ref(false);
const page = usePage()

const removeFinishEventListener = router.on('finish', () => {
    const scroll_position = page.props.scroll_position;
    if (scroll_position) {
        const scroll_id = document.getElementById(scroll_position);
        if (scroll_id) {
            scroll_id.scrollIntoView({ behavior: 'smooth' })
        }
    }
})

onMounted(() => {
    window.addEventListener("resize", handleWindowSizeChange);
    handleWindowSizeChange();
});
onUnmounted(() => {
    removeFinishEventListener();
    window.removeEventListener("resize", handleWindowSizeChange);
});
const handleWindowSizeChange = () => {
    sidebarIsOpen.value = document.documentElement.clientWidth < 640
};

defineProps({ title: { type: String, default: '' } })
</script>

<template>
    <CoreLayout :title="title">
        <template #head>
            <meta name="robots" content="noindex, nofollow">
        </template>
        <Toast />
        <AdminNavbar @toggleSidebar="sidebarIsOpen = !sidebarIsOpen" />
        <AdminSidebar :sidebarIsOpen="sidebarIsOpen" />
        <div class="grid grid-cols-1 px-4 pt-24 sm:ml-64 xl:grid-cols-2 xl:gap-4 dark:bg-gray-900">
            <slot />
        </div>
        <div v-if="!sidebarIsOpen" drawer-backdrop="" @click="sidebarIsOpen = !sidebarIsOpen"
            class="fixed inset-0 z-30 visible bg-gray-900 bg-opacity-50 sm:invisible dark:bg-opacity-80"></div>
    </CoreLayout>
</template>
