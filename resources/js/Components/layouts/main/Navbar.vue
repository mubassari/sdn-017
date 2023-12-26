<script setup>
import { ThemeToggle } from '~Components/core'
import { ref } from '@vue/reactivity'
import { usePage, router } from '@inertiajs/vue3'

const page = usePage()

const sekolah = page.props.sekolah
const auth_user = page.props.auth_user.length > 0

// Menu
const menuContent = ref([
  {
    title: 'Beranda',
    uri: 'index',
    submenu: null
  },
  {
    title: 'Sekolah',
    uri: null,
    submenu: [
      {
        uri: "tentang",
        title: "Tentang Sekolah",
      },
      {
        uri: "sambutan",
        title: "Sambutan Kepala Sekolah",
      },
      {
        uri: "visi_misi_tujuan",
        title: "Visi, Misi & Tujuan",
      },
      {
        uri: "gtk",
        title: "Guru & Tenaga Kependidikan",
      },
    ]
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
])

const nonEmptySosmedValues = Object.values(sekolah.sosmed).filter(value => value !== "");

if (nonEmptySosmedValues.length > 0) {
  const sosmedMenu = {
    title: "Sosial Media",
    uri: null,
    submenu: []
  };

  for (const key in sekolah.sosmed) {
    if (sekolah.sosmed[key] !== "") {
      sosmedMenu.submenu.push({
        title: key.charAt(0).toUpperCase() + key.slice(1),
        uri: 'https://' + sekolah.sosmed[key]
      });
    }
  }

  menuContent.value.push(sosmedMenu);
}

const navbarToggleHide = ref(true);
const submenuOpened = ref(null)

const openSubmenu = (index) => {
  submenuOpened.value = submenuOpened.value == index ? null : index
}
const hideNavbar = () => {
  navbarToggleHide.value = !navbarToggleHide.value;
  submenuOpened.value = null
}

const cari = ref('');

</script>
<template>
  <div
    class="flex-col justify-center hidden px-3 py-1 space-y-5 text-sm text-center bg-gray-100 md:flex dark:bg-gray-800 md:flex-row md:justify-between md:space-x-5 md:space-y-0">
    <ul class="flex flex-col items-center justify-center text-left md:flex-row md:space-x-3">
      <li class="flex items-center space-x-2" v-if="sekolah.umum.email">
        <font-awesome-icon icon="envelope" size="sm" class="mr-1"></font-awesome-icon>
        <span>{{ sekolah.umum.email }}</span>
      </li>
      <li class="flex items-center space-x-2" v-if="sekolah.umum.telepon">
        <font-awesome-icon icon="phone" size="sm" class="mr-1"></font-awesome-icon>
        <span>{{ sekolah.umum.telepon }}</span>
      </li>
      <li class="flex items-center space-x-2" v-if="sekolah.umum.alamat">
        <font-awesome-icon icon="location-dot" size="sm" class="mr-1"></font-awesome-icon>
        <span>{{ sekolah.umum.alamat }}</span>
      </li>
    </ul>
    <div>
      <Link :href="route(auth_user ? 'admin.index' : 'masuk')"
        class="mb-3 text-xs font-bold text-blue-600 dark:text-blue-500 hover:underline">
      {{ auth_user ? 'Admin Panel' : 'Masuk' }}
      <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
      </Link>
    </div>
  </div>
  <nav class="sticky top-0 left-0 z-20 w-full bg-white border-b border-gray-200 dark:bg-gray-900 dark:border-gray-600">
    <div class="flex flex-wrap items-center justify-between max-w-screen-xl max-h-screen p-4 mx-auto md:overflow-hidden"
      :class="{ 'overflow-y-auto': !navbarToggleHide }">
      <Link :href="route('index')" class="flex items-center">
      <img :src="sekolah.umum.logo" class="h-8 mr-3" :alt="sekolah.umum.nama" />
      </Link>

      <div class="items-center justify-between order-2 w-full md:flex md:w-auto" :class="{ 'hidden': navbarToggleHide }">
        <ul
          class="flex flex-col max-h-screen gap-3 p-4 mt-4 overflow-auto font-medium border border-gray-100 rounded-lg md:overflow-hidden md:p-0 bg-gray-50 md:flex-row md:space-x-8 md:mt-0 md:border-0 md:bg-white dark:bg-gray-800 md:dark:bg-gray-900 dark:border-gray-700">
          <li v-for="(menu, index) in menuContent" :key="index">
            <component :is="(menu.uri && !(menu.uri.startsWith('#') || menu.uri.startsWith('/'))) ? 'Link' : 'a'"
              :href="!(menu.uri.startsWith('#') || menu.uri.startsWith('/')) ? route(menu.uri) : menu.uri"
              v-if="!menu.submenu"
              class="block py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
              {{ menu.title }}
            </component>
            <template v-else>
              <button type="button" @click="openSubmenu(index)"
                class="flex items-center justify-between w-full py-2 pl-3 pr-4 text-gray-900 rounded hover:bg-gray-100 md:hover:bg-transparent md:hover:text-blue-700 md:p-0 md:dark:hover:text-blue-500 dark:text-white dark:hover:bg-gray-700 dark:hover:text-white md:dark:hover:bg-transparent dark:border-gray-700">
                <span>{{ menu.title }}</span>
                <font-awesome-icon icon="angle-down" class="ml-2.5"></font-awesome-icon>
              </button>
              <div :class="submenuOpened !== index ? 'hidden' : 'block'"
                class="w-full mt-3 divide-gray-100 rounded-lg shadow bg-gray-50 md:z-20 md:absolute md:mt-3 md:w-44 md:-translate-x-5 divide dark:bg-gray-700">
                <ul class="py-2 text-sm text-gray-700 dark:text-gray-200">
                  <li v-for="(submenu, indexSubmenu) in menu.submenu" :key="indexSubmenu">
                    <Link v-if="Array.isArray(submenu.uri)" :href="route(submenu.uri[0], submenu.uri[1])"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ submenu.title }}
                    </Link>
                    <Link v-else-if="!submenu.uri.startsWith('https://')" :href="route(submenu.uri)"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                    {{ submenu.title }}
                    </Link>
                    <a v-else :href="submenu.uri" target="_blank"
                      class="block px-4 py-2 hover:bg-gray-100 dark:hover:bg-gray-600 dark:hover:text-white">
                      {{ submenu.title }}
                    </a>
                  </li>
                </ul>
              </div>
            </template>
          </li>
        </ul>
        <div class="flex justify-end mt-4 md:ml-8 md:mt-0">
          <form class="flex w-full me-3" @submit.prevent="router.get(route('cari', cari.replace(' ', '-')))">
            <input type="text" v-model="cari"
              class="flex-1 order text-sm block w-full p-2.5 bg-gray-50 border-gray-300 text-gray-900 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500 rounded-l-lg"
              name="cari" id="cari" placeholder="Cari Artikel">
            <button type="submit" :disabled="cari.length < 3" :class="{ 'cursor-not-allowed': cari.length < 3 }"
              class="inline-flex items-center px-3 text-sm font-medium text-center text-white bg-gray-800 rounded-r-lg hover:bg-gray-900 focus:outline-none focus:ring-4 focus:ring-gray-300 dark:bg-gray-800 dark:hover:bg-gray-700 dark:focus:ring-gray-700 dark:border-gray-700">
              <font-awesome-icon icon="magnifying-glass" size="lg"></font-awesome-icon>
            </button>
          </form>
          <ThemeToggle />
        </div>
      </div>

      <div class="flex order-1">
        <button type="button" @click="hideNavbar"
          class="inline-flex items-center justify-center w-10 h-10 p-2 ml-3 text-sm text-gray-500 rounded-lg md:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-700 dark:focus:ring-gray-600"
          aria-controls="navbar-sticky" aria-expanded="false">
          <span class="sr-only">Open main menu</span>
          <font-awesome-icon icon="bars" size="2x"></font-awesome-icon>
        </button>
      </div>

    </div>
  </nav>
</template>