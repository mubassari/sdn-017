<script setup>
import { ref } from "@vue/reactivity"
import { MainLayout } from '~Layouts';

const title = ref("Visi, Misi & Tujuan");

const props = defineProps({
  visi_misi_tujuan: { type: Object, required: true }
})
</script>

<template>
  <MainLayout :title="title" :description="title" keyword="visi,misi,tujuan">
    <div class="flex flex-col items-center justify-center pt-24 bg-white dark:bg-gray-900">
      <h1
        class="my-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
        {{ title }}
      </h1>
      <div class="w-full px-4 py-8 mx-auto lg:w-fit lg:py-16 lg:px-6">
        <div class="gap-6 space-y-8 lg:grid lg:grid-cols-2 lg:space-y-0">
          <div
            class="w-full max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow lg:max-w-full col-span-full dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
            <h3 class="text-3xl font-extrabold uppercase">Visi</h3>
            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
            <!-- List -->
            <ul role="list" class="text-center divide-y-2 divide-gray-100 dark:divide-gray-700">
              <li class="py-4">
                “{{ visi_misi_tujuan.visi }}”
              </li>
            </ul>
          </div>
          <div
            class="w-full max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
            <h3 class="text-3xl font-extrabold uppercase">Misi</h3>
            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
            <!-- List -->
            <ul role="list" class="text-center divide-y-2 divide-gray-100 dark:divide-gray-700">
              <li class="py-4" v-for="(misi, misi_key) in visi_misi_tujuan.misi" :key="misi_key">
                “{{ misi }}”
              </li>
            </ul>
          </div>
          <div
            class="w-full max-w-lg p-6 mx-auto text-center text-gray-900 bg-white border border-gray-100 rounded-lg shadow dark:border-gray-600 xl:p-8 dark:bg-gray-800 dark:text-white">
            <h3 class="text-3xl font-extrabold uppercase">Tujuan</h3>
            <hr class="w-48 h-1 mx-auto my-4 bg-gray-100 border-0 rounded dark:bg-gray-700">
            <!-- List -->
            <ul role="list" class="text-center divide-y-2 divide-gray-100 dark:divide-gray-700">
              <li class="py-4" v-for="(tujuan, tujuan_key) in visi_misi_tujuan.tujuan" :key="tujuan_key">
                “{{ tujuan }}”
              </li>
            </ul>
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>