<script setup>
import { ref } from '@vue/reactivity'
import submenu from '~Stores/submenu'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const user_role = page.props.auth_user.role.slug

defineProps({ 'sidebarIsOpen': { default: false } })

// Menu
const menuContent = ref([
  {
    title: 'Beranda',
    uri: 'admin.index',
    icon: 'house',
    role: null,
    submenu: null
  },
  {
    title: 'Artikel',
    uri: 'admin.artikel.index',
    icon: 'newspaper',
    role: ['penulis'],
    submenu: null
  },
  {
    title: 'Sekolah',
    uri: null,
    icon: 'school',
    role: ['admin', 'admin-gtk'],
    submenu: [
      {
        title: 'Umum',
        uri: 'admin.sekolah.index',
        role: ['admin'],
      },
      {
        title: 'Sambutan',
        uri: 'admin.sambutan.index',
        role: ['admin'],
      },
      {
        title: 'Visi, Misi & Tujuan',
        uri: 'admin.visi_misi_tujuan.index',
        role: ['admin'],
      },
      {
        title: 'GTK',
        uri: 'admin.gtk.index',
        role: ['admin', 'admin-gtk'],
      }
    ],
  },
  {
    title: 'Pengguna',
    uri: 'admin.user.index',
    icon: 'users',
    role: ['super-admin'],
    submenu: null
  },
])
</script>
<template>
  <aside id="logo-sidebar" :class="{ '-translate-x-full': sidebarIsOpen }"
    class="fixed top-0 left-0 z-40 w-64 h-screen pt-20 transition-transform bg-white border-r border-gray-200 sm:translate-x-0 dark:bg-gray-800 dark:border-gray-700"
    aria-label="Sidebar">
    <div class="h-full px-3 pb-4 overflow-y-auto bg-white dark:bg-gray-800">
      <ul class="space-y-2 font-medium">
        <template v-for="(menu, index) in menuContent" :key="index">
          <li v-if="menu.role ? (menu.role.includes(user_role) || user_role == 'super-admin') : true">
            <Link :href="route(menu.uri)" v-if="!menu.submenu"
              class="flex items-center p-2 text-gray-900 rounded-lg dark:text-white hover:bg-gray-100 dark:hover:bg-gray-700 group">
            <font-awesome-icon :icon="menu.icon"
              class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></font-awesome-icon>
            <span class="ml-3">{{ menu.title }}</span>
            </Link>
            <template v-else>
              <button type="button" @click="submenu.set(index)"
                class="flex items-center w-full p-2 text-base text-gray-900 transition duration-75 rounded-lg group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                <font-awesome-icon :icon="menu.icon"
                  class="flex-shrink-0 w-5 h-5 text-gray-500 transition duration-75 group-hover:text-gray-900 dark:text-gray-400 dark:group-hover:text-white"></font-awesome-icon>
                <span class="flex-1 ml-3 text-left whitespace-nowrap">{{ menu.title }}</span>
                <font-awesome-icon icon="angle-down" class="ml-2.5"></font-awesome-icon>
              </button>
              <ul class="py-2 space-y-2" :class="submenu.opened !== index ? 'hidden' : ''">
                <template v-for="(submenu, indexSubmenu) in menu.submenu" :key="indexSubmenu">
                  <li v-if="submenu.role ? (submenu.role.includes(user_role) || user_role == 'super-admin') : true">
                    <Link :href="route(submenu.uri)"
                      class="flex items-center w-full p-2 text-gray-900 transition duration-75 rounded-lg pl-11 group hover:bg-gray-100 dark:text-white dark:hover:bg-gray-700">
                    {{ submenu.title }}
                    </Link>
                  </li>
                </template>
              </ul>
            </template>
          </li>
        </template>
      </ul>
    </div>
  </aside>
</template>