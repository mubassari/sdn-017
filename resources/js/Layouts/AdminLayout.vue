<script setup>
import { ref, onMounted, onUnmounted } from "vue";
import { AdminNavbar, AdminSidebar, Toast } from "~Components/layouts"

let sidebarIsOpen = ref(false);

onMounted(() => {
    window.addEventListener("resize", handleWindowSizeChange);
    handleWindowSizeChange();
});
onUnmounted(() => {
    window.removeEventListener("resize", handleWindowSizeChange);
});
const handleWindowSizeChange = () => {
    sidebarIsOpen.value = document.documentElement.clientWidth < 640
};

</script>

<template>
    <Toast />
    <AdminNavbar @toggleSidebar="sidebarIsOpen = !sidebarIsOpen" />
    <AdminSidebar :sidebarIsOpen="sidebarIsOpen" />

    <div class="pt-20 sm:ml-64">
        <slot />
    </div>
    <div v-if="!sidebarIsOpen" drawer-backdrop="" @click="sidebarIsOpen = !sidebarIsOpen"
        class="bg-gray-900 bg-opacity-50 visible sm:invisible dark:bg-opacity-80 fixed inset-0 z-30"></div>
</template>
