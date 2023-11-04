<script setup>
import { Pagination } from '~Components/core'
import { AdminLayout } from '~Layouts';
import { router } from "@inertiajs/vue3";
import { ref, watch } from 'vue';

const title = ref('Daftar GTK');
const cari = ref(null)
defineProps({ list_gtk: { type: Object, required: true } })

watch(
  cari, async () => {
    await loadLodash();
    await _.debounce((value) => {
      router.get(
        router.page.url,
        { cari: value },
        { preserveState: true, replace: true }
      );
    }, 100)
  }
);

const deleteData = (route) => {
  router.delete(route, {
    onBefore: () => confirm("Apakah Anda yakin ingin menghapus data ini?"),
  });
}

</script>

<template>
  <AdminLayout :title="title">
    <div class="mb-4 col-span-full xl:mb-2">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
      <div class="items-center justify-between md:flex md:space-x-2">
        <div class="flex gap-2">
          <Link :href="route('admin.gtk.tambah')">
          <button type="button" title="Tambah GTK"
            class="inline-flex items-center justify-center px-3 py-2 mb-2 mr-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg sm:mb-0 hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <font-awesome-icon icon="plus" class="mr-2"></font-awesome-icon>
            Tambah GTK
          </button>
          </Link>
          <Link :href="route('admin.gtk.jabatan.index')">
          <button type="button" title="Kelola"
            class="inline-flex items-center justify-center px-3 py-2 mb-2 mr-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:ring-blue-300 sm:w-auto dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
            <font-awesome-icon icon="folder-plus" class="mr-2"></font-awesome-icon>
            Kelola Jabatan
          </button>
          </Link>
        </div>
        <div class="mb-2 bg-white dark:bg-gray-900">
          <label for="table-search" class="sr-only">Pencarian</label>
          <div class="relative">
            <div class="absolute inset-y-0 left-0 flex items-center pl-3 pointer-events-none">
              <font-awesome-icon icon="magnifying-glass"></font-awesome-icon>
            </div>
            <input type="text" id="table-search"
              class="block w-full p-2 pl-10 text-sm text-gray-900 border border-gray-300 rounded-lg max-w-80 bg-gray-50 focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:placeholder-gray-400 dark:text-white dark:focus:ring-blue-500 dark:focus:border-blue-500"
              placeholder="Cari GTK" v-model="cari">
          </div>
        </div>
      </div>
    </div>
    <div class="mb-4 col-span-full xl:mb-2">
      <div class="relative overflow-x-auto shadow-md">
        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
          <thead class="text-xs text-gray-700 uppercase bg-gray-100 dark:bg-gray-700 dark:text-gray-400">
            <tr>
              <th scope="col" class="px-6 py-3">
                Foto
              </th>
            <th scope="col" class="px-6 py-3">
              Nama
            </th>
            <th scope="col" class="px-6 py-3">
                Jabatan
              </th>
              <th scope="col" class="px-6 py-3">
                <span class="sr-only">Opsi</span>
              </th>
            </tr>
          </thead>
          <tbody>
            <template v-if="list_gtk.data.length > 0">
              <tr v-for="(gtk, key) in list_gtk.data" :key="key"
                class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td class="w-32 px-6 py-4">
                  <img v-if="gtk.sampul" :src="gtk.sampul" :alt="gtk.nama" class="rounded">
                </td>
                <td class="px-6 py-4">
                  {{ gtk.nama }}
                </td>
                <td class="px-6 py-4">
                  <span
                    class="bg-blue-100 text-blue-800 text-xs font-semibold mr-3 px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                    {{ gtk.jabatan }}
                  </span>
                </td>
                <td class="px-6 py-4 text-right whitespace-nowrap">
                  <!-- <Link :href="route('gtk.tampil', [gtk.jabatan_slug, gtk.slug])" title="Lihat"
                      class="focus:outline-none text-white bg-green-700 hover:bg-green-800 focus:ring-4 focus:ring-green-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-green-600 dark:hover:bg-green-700 dark:focus:ring-green-800">
                    <font-awesome-icon icon="eye"></font-awesome-icon>
                    <span class="sr-only">Lihat</span>
                    </Link> -->
                  <Link :href="route('admin.gtk.ubah', gtk.id)" title="Ubah"
                    class="text-white bg-blue-700 hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
                  <font-awesome-icon icon="pen-to-square"></font-awesome-icon>
                  <span class="sr-only">Ubah</span>
                  </Link>
                  <button @click.prevent="deleteData(route('admin.gtk.hapus', gtk.id))" title="Hapus"
                    class="focus:outline-none text-white bg-red-700 hover:bg-red-800 focus:ring-4 focus:ring-red-300 font-medium rounded-lg text-sm p-2.5 mr-2 mb-2 text-center dark:bg-red-600 dark:hover:bg-red-700 dark:focus:ring-red-900">
                    <font-awesome-icon icon="trash"></font-awesome-icon>
                    <span class="sr-only">Hapus</span>
                  </button>
                </td>
              </tr>
            </template>
            <template v-else>
              <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-700">
                <td colspan="4" class="px-6 py-4 text-base text-center whitespace-nowrap">Tidak Ada Data</td>
              </tr>
            </template>
          </tbody>
        </table>
      </div>
      <Pagination :links="list_gtk.links" :dari="list_gtk.from" :ke="list_gtk.to" :total="list_gtk.total" />
    </div>
  </AdminLayout>
</template>