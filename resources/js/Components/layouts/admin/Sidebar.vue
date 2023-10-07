<script setup>
defineProps({ 'sidebarIsOpen': { default: false } })
</script>
<template>
  <aside id="logo-sidebar" :class="{ '-translate-x-full': sidebarIsOpen }"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        <li>
          <Link :href="route('admin.index')"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <font-awesome-icon icon="house"></font-awesome-icon>
            <span class="ml-3">Beranda</span>
          </Link>
        </li>
        <li>
          <Link :href="route('admin.artikel.index')"
            class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <font-awesome-icon icon="newspaper"></font-awesome-icon>
            <span class="ml-3">Artikel</span>
          </Link>
        </li>
      </ul>
    </div>
  </aside>
</template>