<script setup>
import { ref } from "@vue/reactivity"
import { MainLayout } from '~Layouts';

const props = defineProps({
  'sekolah': { type: Object, required: true },
  'lokasi': { type: Object, required: true },
})

const title = ref("Tentang Sekolah");

const datas = ref([
  {
    title: 'Nama Sekolah',
    value: props.sekolah.umum.nama
  },
  {
    title: 'Alamat Sekolah',
    value: props.sekolah.umum.alamat
  },
  {
    title: 'NPSN',
    value: props.sekolah.umum.npsn
  },
  {
    title: 'NSS',
    value: props.sekolah.umum.nss
  },
  {
    title: 'Email',
    value: props.sekolah.umum.email
  },
  {
    title: 'Telepon',
    value: props.sekolah.umum.telepon
  },
  props.sekolah.sosmed.facebook ?
    {
      title: 'Akun Facebook',
      value: props.sekolah.sosmed.facebook
    } : null,
  props.sekolah.sosmed.instagram ?
    {
      title: 'Akun Instagram',
      value: props.sekolah.sosmed.instagram
    } : null,
  props.sekolah.sosmed.tiktok ?
    {
      title: 'Akun TikTok',
      value: props.sekolah.sosmed.tiktok
    } : null,
  props.sekolah.sosmed.twitter ?
    {
      title: 'Akun Twitter',
      value: props.sekolah.sosmed.twitter
    } : null,
])

</script>

<template>
  <MainLayout :title="title" :description="title">
    <div class="flex flex-col items-center justify-center pt-24 bg-white dark:bg-gray-900">
      <h1
        class="my-3 text-3xl font-extrabold leading-none tracking-tight text-center text-gray-900 uppercase dark:text-white md:text-4xl lg:text-5xl">
        {{ title }}
      </h1>
      <div class="w-ull px-4 py-8 mx-auto lg:w-3/4 lg:py-16 lg:px-6">
        <div
          class="grid grid-cols-2 px-4 py-5 text-sm font-medium text-gray-900 border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
        </div>
        <template v-for="(data, key) in datas">
          <div v-if="data" :key="key"
            class="grid grid-cols-2 px-4 py-5 text-sm text-gray-900 border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
            <div class="font-medium">{{ data.title }}</div>
            <div>{{ data.value }}</div>
          </div>
        </template>
        <div v-if="lokasi.longitude !== '0' && lokasi.latitude !== '0'"
          class="grid grid-cols-1 px-4 py-5 text-sm font-medium text-gray-900 border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
          <div class="font-medium mb-3">Lokasi Sekolah</div>
          <div class="flex justify-center">
            <iframe
              :src="'https://maps.google.com/maps?q=' + lokasi.latitude + ',%20' + lokasi.longitude + '&z=18&output=embed'" class="w-3/4 h-72 border-0 rounded-lg" allowfullscreen="" loading="lazy"
              referrerpolicy="no-referrer-when-downgrade"></iframe>
          </div>
        </div>
        <div v-if="sekolah.umum.logo !== '/gambar/default-sekolah.png'"
          class="grid grid-cols-1 px-4 py-5 text-sm font-medium text-gray-900 border-b border-gray-200 gap-x-16 dark:bg-gray-800 dark:border-gray-700 dark:text-white">
          <div class="font-medium mb-3">Logo Sekolah</div>
          <div class="flex justify-center">
            <img class="rounded-lg h-auto w-3/4" :src="sekolah.umum.logo">
          </div>
        </div>
      </div>
    </div>
  </MainLayout>
</template>