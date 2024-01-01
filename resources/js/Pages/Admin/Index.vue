<script setup>
import { AdminLayout } from '~Layouts';
import { usePage } from '@inertiajs/vue3'
import { ref } from '@vue/reactivity'

const page = usePage()
const user = page.props.auth_user
const sekolah = page.props.sekolah

const menuContent = ref([
  {
    title: 'Artikel',
    uri: 'admin.artikel.index',
    icon: 'newspaper',
    role: ['penulis'],
  },
  {
    title: 'Sekolah',
    uri: 'admin.sekolah.index',
    icon: 'school',
    role: ['admin'],
  },
  {
    title: 'Pengguna',
    uri: 'admin.user.index',
    icon: 'users',
    role: ['super-admin'],
  },
  {
    title: 'Pengaturan',
    uri: 'admin.pengaturan.index',
    icon: 'gear',
    role: ['super-admin'],
  },
])
</script>

<template>
  <AdminLayout title="Admin">
    <div class="mb-4 col-span-full xl:mb-2">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        Halo <span class="font-bold">{{ user.nama ?? '@' + user.username }}</span>,
        Selamat Datang di <span class="font-bold">{{ sekolah.umum.nama }}</span>!
      </h1>
    </div>
    <div class="col-span-full">
      <div class="grid sm:grid-cols-2 gap-3">
        <template v-for="(info, index) in menuContent">
          <Link :href="route(info.uri)" :key="index"
            v-if="info.role ? (info.role.includes(user.role.slug) || user.role.slug == 'super-admin') : true"
            class="block p-6 bg-white border border-gray-200 rounded-lg shadow hover:bg-gray-100 dark:bg-gray-800 dark:border-gray-700 dark:hover:bg-gray-700">
          <font-awesome-icon :icon="info.icon" class="mb-3 text-gray-500 w-7 h-7 dark:text-gray-400"></font-awesome-icon>
          <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
            {{ info.title }}
          </h5>
          </Link>
        </template>
      </div>
    </div>
  </AdminLayout>
</template>