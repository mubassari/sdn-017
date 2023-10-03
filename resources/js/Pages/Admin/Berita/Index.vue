<script setup>
import { Pagination } from '~Components/core'
import { AdminLayout } from '~Layouts';
import { Head, router } from "@inertiajs/vue3";
import { ref } from 'vue';

let title = ref('Daftar Berita');
defineProps({ list_berita: { type: Object, required: true } })

const deleteData = (route) => {
  router.delete(route, {
    onBefore: () => confirm("Apakah Anda yakin ingin menghapus data ini?"),
  });
}

</script>

<template>
  <Head :title="title" />
  <AdminLayout>
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
      <div class="items-center justify-between block sm:flex md:divide-x md:divide-gray-100 dark:divide-gray-700">
        <Link :href="route('admin.berita.tambah')">
        <button type="button" title="Tambah"
          class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
          Tambah Berita
        </button>
        </Link>
      </div>
    </div>
    <div class="relative overflow-x-auto shadow-md">
      <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
        <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
          <tr>
            <th scope="col" class="px-6 py-3">
              Judul
            </th>
            <th scope="col" class="px-6 py-3">
              Sampul
            </th>
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Opsi</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <template v-if="list_berita.data.length > 0">
            <tr v-for="(berita, key) in list_berita.data" :key="key"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
              <th scope="row" class="px-6 py-4 font-medium uppercase text-gray-900 whitespace-nowrap dark:text-white">
                <div class="text-base font-semibold">{{ berita.judul }}</div>
                <div class="font-normal text-gray-500 italic">{{ berita.waktu }}</div>
              </th>
              <td class="w-32 p-4">
                <img v-if="berita.sampul" :src="berita.sampul" :alt="berita.judul" class="rounded">
              </td>
              <td class="px-6 py-4 text-right whitespace-nowrap">
                <a href="#" title="Lihat"
                  class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                  <font-awesome-icon icon="eye"></font-awesome-icon>
                  <span class="sr-only">Lihat</span>
                </a>
                <Link :href="route('admin.berita.ubah', berita.id)" title="Ubah"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <font-awesome-icon icon="pen-to-square"></font-awesome-icon>
                <span class="sr-only">Ubah</span>
                </Link>
                <button @click.prevent="deleteData(route('admin.berita.hapus', berita.id))" title="Hapus"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                  <font-awesome-icon icon="trash"></font-awesome-icon>
                  <span class="sr-only">Hapus</span>
                </button>
              </td>
            </tr>
          </template>
          <template v-else>
            <tr colspan="3"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-600">
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <Pagination :links="list_berita.links.slice(1, -1)" :dari="list_berita.from" :ke="list_berita.to" :total="list_berita.total" />
  </AdminLayout>
</template>