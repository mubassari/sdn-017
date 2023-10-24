<script setup>
import { ThemeToggle } from '~Components/core'
import { ref } from 'vue'
import { usePage } from '@inertiajs/vue3'

const page = usePage()

// Menu
const menuContent = ref([
  {
    title: 'Home',
    uri: '/',
    submenu: null
  },
  {
    title: 'Artikel',
    uri: null,
    submenu: page.props.page_content.list_kategori.map(el => {
      return {
        title: el.nama,
        uri: ['artikel.index', el.slug]
      }
    }
    ),
  },
  {
    title: 'Kontak',
    uri: '/artikel',
    submenu: null
  },
  {
    title: 'Lainnya',
    uri: null,
    submenu: [
      {
        title: 'Pemberitahuan',
        uri: 'pemberitahuan',
      }, {
        title: 'Berita',
        uri: 'berita',
      }
    ],
  },
])

const navbarToggleHide = ref(true);
const submenuOpened = ref(null)

const openSubmenu = (index) => {
  submenuOpened.value = submenuOpened.value == index ? null : index
}
const hideNavbar = () => {
  navbarToggleHide.value = !navbarToggleHide.value;
  submenuOpened.value = null
}
// End Menu
</script>
<template>
  <nav class="fixed bg-white dark:bg-gray-900 w-full z-20 top-0 left-0 border-b border-gray-200 dark:border-gray-600">
    <div class="max-w-screen-xl flex flex-wrap items-center justify-between mx-auto p-4">
      <a href="https://flowbite.com/" class="flex items-center">
        <img src="https://flowbite.com/docs/images/logo.svg" class="h-8 mr-3" alt="Flowbite Logo">
      </a>
      <div class="flex md:order-2">
        <ThemeToggle />
        <button type="button" @click="hideNavbar"
          class="inline-flex items-center p-2 ml-3 w-10 h-10 justify-center text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <font-awesome-icon icon="bars" size="2x"></font-awesome-icon>
        </button>
      </div>

      <div class="items-center justify-between w-full md:flex md:w-auto md:order-1"
        :class="navbarToggleHide ? 'hidden' : ''">
        <ul
          class="overflow-auto max-h-screen flex flex-col p-4 md:p-0 mt-4 gap-3 font-medium border border-gray-100 rounded-lg bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li v-for="(menu, index) in menuContent" :key="index">
            <component :is="(menu.uri && !menu.uri.startsWith('#')) ? 'Link' : 'a'" :href="menu.uri" v-if="!menu.submenu"
              class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
              {{ menu.title }}</component>
            <template v-else>
              <button type="button" @click="openSubmenu(index)"
                class="flex justify-between items-center w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                <span>{{ menu.title }}</span>
                <font-awesome-icon icon="caret-down" class="ml-2.5"></font-awesome-icon>
              </button>
              <div :class="submenuOpened !== index ? 'hidden' : 'block'"
                class="md:z-20 md:absolute md:mt-3 w-full md:w-44 mt-3 md:-translate-x-5 bg-white divide divide-gray-100 rounded-lg shadow dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                  <li v-for="(submenu, indexSubmenu) in menu.submenu" :key="indexSubmenu">
                    <Link :href="Array.isArray(submenu.uri) ? route(submenu.uri[0], submenu.uri[1]) : submenu.uri"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ submenu.title }}
                    </Link>
                  </li>
                </ul>
              </div>
            </template>
          </li>
        </ul>
      </div>
    </div>
  </nav>
</template>