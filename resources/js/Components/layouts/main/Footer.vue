<script setup>
import { usePage } from '@inertiajs/vue3'

const page = usePage()

const sekolah = page.props.sekolah
const auth_user = page.props.auth_user.length > 0
</script>
<template>
  <!-- Footer -->
  <footer class="p-4 bg-gray-100 scroll-my-20 sm:p-6 dark:bg-gray-800">
    <div
      class="flex flex-col justify-center space-y-5 text-sm text-center bg-gray-100 dark:bg-gray-800 md:flex-row md:justify-between md:space-x-5 md:space-y-0">
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
        <Link :href="route(auth_user ? 'admin.index' : 'masuk')" rel="nofollow"
          class="px-3 py-2 text-xs text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
        {{ auth_user ? 'Admin Panel' : 'Masuk' }}
        </Link>
      </div>
    </div>
    <hr class="my-6 border-gray-200 sm:mx-auto dark:border-gray-700 lg:my-8" />
    <div class="text-center sm:flex sm:items-center sm:justify-between">
      <span class="text-sm text-gray-500 sm:text-center dark:text-gray-400">© {{ new Date().getFullYear() }}
        <Link :href="route('index')" class="hover:underline">{{ sekolah.umum.nama }}</Link>
      </span>
      <div class="flex justify-center mt-4 space-x-6 sm:mt-0">
        <a v-if="sekolah.sosmed.facebook" :href="sekolah.sosmed.facebook" target="_blank"
          class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
          <font-awesome-icon icon="fa-brands fa-facebook" size="sm"></font-awesome-icon>
        </a>
        <a v-if="sekolah.sosmed.instagram" :href="sekolah.sosmed.instagram"
          class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
          <font-awesome-icon icon="fa-brands fa-instagram" size="sm"></font-awesome-icon>
        </a>
        <a v-if="sekolah.sosmed.tiktok" :href="sekolah.sosmed.tiktok"
          class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
          <font-awesome-icon icon="fa-brands fa-tiktok" size="sm"></font-awesome-icon>
        </a>
        <a v-if="sekolah.sosmed.twitter" :href="sekolah.sosmed.twitter"
          class="text-gray-500 hover:text-gray-900 dark:hover:text-white">
          <font-awesome-icon icon="fa-brands fa-twitter" size="sm"></font-awesome-icon>
        </a>
      </div>
    </div>
  </footer>
  <!-- End Footer -->
</template>