<script setup>
import { Pagination } from '~Components/core'
import { MainLayout } from '~Layouts';

const props = defineProps({
  'kategori': { type: Object, required: true },
  'list_artikel': { type: Object, required: true }
})

</script>

<template>
  <MainLayout :title="kategori.nama">
    <div class="pt-24 bg-white dark:bg-gray-900 flex flex-col items-center justify-center ">
      <h1
        class="my-3 text-3xl font-extrabold tracking-tight leading-none text-gray-900 dark:text-white text-center uppercase md:text-4xl lg:text-5xl">
        {{ kategori.nama }}
      </h1>
      <div class="py-4 px-4 mx-auto max-w-screen-xl md:py-16 lg:px-6">
        <div class="space-y-4 md:grid xl:grid-cols-4 md:grid-cols-2 sm:gap-3 xl:gap-5 md:space-y-0">
          <div v-for="artikel in list_artikel.data" :key="artikel.id"
            class="max-w-sm bg-white border border-gray-200 rounded-lg shadow dark:bg-gray-800 dark:border-gray-700">
            <img class="rounded-t-lg w-full" :src="artikel.sampul" />
            <div class="p-5">
              <h5 class="mb-2 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ artikel.judul }}
              </h5>
              <div class="mt-2.5 mb-5 space-y-1">
                <span
                  class="bg-blue-100 text-blue-800 text-xs font-semibold px-2.5 py-0.5 rounded dark:bg-blue-200 dark:text-blue-800">
                  {{ artikel.kategori }}
                </span>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                  {{ artikel.waktu }}
                </p>
              </div>
              <Link :href="route('artikel.tampil', [kategori.slug, artikel.slug])"
                class="px-3 py-2 text-sm font-medium text-center text-white bg-blue-700 rounded-lg hover:bg-blue-800 focus:ring-4 focus:outline-none focus:ring-blue-300 dark:bg-blue-600 dark:hover:bg-blue-700 dark:focus:ring-blue-800">
              Baca Selengkapnya
              <font-awesome-icon icon="arrow-right-long" class="ml-1"></font-awesome-icon>
              </Link>
            </div>
          </div>
        </div>
        <Pagination :links="list_artikel.links" :dari="list_artikel.from" :ke="list_artikel.to"
          :total="list_artikel.total" class="pt-10 px-5 m-2" />
      </div>
    </div>
  </MainLayout>
</template>