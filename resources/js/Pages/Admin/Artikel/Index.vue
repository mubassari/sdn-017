<script setup>
import { Pagination } from '~Components/core'
import { AdminLayout } from '~Layouts';
import { router } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Daftar Artikel');
defineProps({ list_artikel: { type: Object, required: true } })

const deleteData = (route) => {
  router.delete(route, {
    onBefore: () => confirm("Apakah Anda yakin ingin menghapus data ini?"),
  });
}

</script>

<template>
  <AdminLayout :title="title">
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
      <div class="items-center sm:flex sm:space-x-2">
        <Link :href="route('admin.artikel.tambah')">
        <button type="button" title="Tambah"
          class="inline-flex items-center justify-center w-1/2 px-3 py-2 mr-2 mb-2 sm:mb-0 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
          Tambah Artikel
        </button>
        </Link>
        <Link :href="route('admin.kategori.index')">
        <button type="button" title="Tambah"
          class="inline-flex items-center justify-center w-1/2 px-3 py-2 text-sm font-medium text-center text-white rounded-lg bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
          <font-awesome-icon icon="folder-plus" class="mr-2"></font-awesome-icon>
          Tambah Kategori
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
              Kategori
            </th>
            <th scope="col" class="px-6 py-3">
              <span class="sr-only">Opsi</span>
            </th>
          </tr>
        </thead>
        <tbody>
          <template v-if="list_artikel.data.length > 0">
            <tr v-for="(artikel, key) in list_artikel.data" :key="key"
              class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
              <th scope="row" class="px-6 py-4 font-medium uppercase text-gray-900 whitespace-nowrap dark:text-white">
                <div class="text-base font-semibold">{{ artikel.judul }}</div>
                <div class="font-normal text-gray-500 italic">{{ artikel.waktu }}</div>
              </th>
              <td class="w-32 px-6 py-4">
                <img v-if="artikel.sampul" :src="artikel.sampul" :alt="artikel.judul" class="rounded">
              </td>
              <td class="px-6 py-4">
                <span
                  class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                  {{ artikel.kategori }}
                </span>
              </td>
              <td class="px-6 py-4 text-right whitespace-nowrap">
                <Link :href="route('artikel.tampil', [artikel.kategori_slug, artikel.slug])" title="Lihat"
                  class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                <font-awesome-icon icon="eye"></font-awesome-icon>
                <span class="sr-only">Lihat</span>
                </Link>
                <Link :href="route('admin.artikel.ubah', artikel.id)" title="Ubah"
                  class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                <font-awesome-icon icon="pen-to-square"></font-awesome-icon>
                <span class="sr-only">Ubah</span>
                </Link>
                <button @click.prevent="deleteData(route('admin.artikel.hapus', artikel.id))" title="Hapus"
                  class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                  <font-awesome-icon icon="trash"></font-awesome-icon>
                  <span class="sr-only">Hapus</span>
                </button>
              </td>
            </tr>
          </template>
          <template v-else>
            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
              <td colspan="3" class="px-6 py-4 text-center whitespace-nowrap text-base">Tidak Ada Data</td>
            </tr>
          </template>
        </tbody>
      </table>
    </div>
    <Pagination :links="list_artikel.links" :dari="list_artikel.from" :ke="list_artikel.to" :total="list_artikel.total" />
  </AdminLayout>
</template>