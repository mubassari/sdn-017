<script setup>
import { ref } from "@vue/reactivity"
import { usePage } from "@inertiajs/vue3";
import { MainLayout } from '~Layouts';

const page = usePage()

const props = defineProps({
  'sambutan': { type: Object, required: true },
  'kepala_sekolah': { type: Object, required: true }
})

const sekolah = page.props.sekolah.umum

const title = ref("Sambutan Kepala Sekolah")
</script>

<template>
  <MainLayout :title="title" :description="title" keyword="sambutan">
    <div class="flex flex-col items-center justify-center pt-24 bg-white dark:bg-gray-900">
      <h1
        class="my-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
        {{ title }}
      </h1>
      <div class="pt-8 pb-16 antialiased bg-white lg:pt-16 lg:pb-24 dark:bg-gray-900">
        <div class="flex justify-between max-w-screen-xl px-4 mx-auto ">
          <article
            class="w-full max-w-2xl mx-auto format format-sm sm:format-base lg:format-lg format-blue dark:format-invert">
            <div v-html="sambutan.isi"></div>
            <header class="flex flex-col items-center justify-center mb-4 no-format lg:mb-6">
              <img class="w-16 h-16 rounded-full" :src="kepala_sekolah.foto" :alt="kepala_sekolah.nama">
              <address class="flex items-center mb-6 space-x-3 not-italic">
                <div class="flex items-center divide-x-2 divide-gray-500 dark:divide-gray-700">
                  <div class="pr-3 font-medium text-gray-900 dark:text-white">
                    {{ kepala_sekolah.nama }}
                  </div>
                  <div class="pl-3 text-sm font-light text-gray-500 dark:text-gray-400">
                    Kepala Sekolah {{ sekolah.nama }}
                  </div>
                </div>
              </address>
            </header>
          </article>
        </div>
      </div>
    </div>
  </MainLayout>
</template>