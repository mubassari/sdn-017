<script setup>
import { ref } from "@vue/reactivity"
import { MainLayout } from '~Layouts';

const title = ref("Daftar GTK");

const props = defineProps({
  kepala_sekolah: { type: Object, required: true },
  gtk_list: { type: Object, required: true }
})
</script>

<template>
  <MainLayout :title="title" :description="title" keyword="gtk,guru,tendik">
    <div class="flex flex-col items-center justify-center pt-24 bg-white dark:bg-gray-900">
      <h1
        class="my-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
        {{ title }}
      </h1>
      <div class="w-full px-4 py-8 mx-auto lg:w-fit lg:py-16 lg:px-6">
        <template v-if="kepala_sekolah">
          <div class="max-w-screen-sm mx-auto my-16 text-center">
            <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
              Kepala Sekolah
            </h2>
          </div>
          <div class="grid grid-cols-2 gap-8 lg:gap-16 md:grid-cols-3 lg:grid-cols-4 justify-items-center">
            <div class="text-center text-gray-500 dark:text-gray-400">
              <img class="mx-auto mb-4 rounded-full w-36 h-36" :src="kepala_sekolah.foto" :alt="kepala_sekolah.nama">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ kepala_sekolah.nama }}
              </h3>
              <p>NIP. {{ kepala_sekolah.nip }}</p>
            </div>
          </div>
        </template>
        <template v-for="jabatan in gtk_list" :key="jabatan.id">
          <div class="max-w-screen-sm mx-auto my-16 text-center">
            <h2 class="mb-4 text-4xl font-extrabold tracking-tight text-gray-900 dark:text-white">
              {{ jabatan.nama }}
            </h2>
          </div>
          <div class="grid grid-cols-2 gap-8 lg:gap-16 md:grid-cols-3 lg:grid-cols-4 justify-items-center">
            <div class="text-center text-gray-500 dark:text-gray-400" v-for="gtk in jabatan.gtk" :key="gtk.id">
              <img class="mx-auto mb-4 rounded-full w-36 h-36" :src="gtk.foto" :alt="gtk.nama">
              <h3 class="mb-1 text-2xl font-bold tracking-tight text-gray-900 dark:text-white">
                {{ gtk.nama }}
              </h3>
              <p>NIP. {{ gtk.nip }}</p>
            </div>
          </div>
        </template>
      </div>
    </div>
  </MainLayout>
</template>