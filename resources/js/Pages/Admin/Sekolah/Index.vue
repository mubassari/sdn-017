<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from '~Components/core'
import { FormUmumSekolah, FormSosmedSekolah } from '~Components/forms'
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Pengaturan Data Sekolah');

const props = defineProps({
  umum: { type: Object, required: true },
  sosmed: { type: Object, required: true },
})

const umum = useForm({
  nama: props.umum.nama,
  logo: props.umum.logo,
  ikon: props.umum.ikon,
  alamat: props.umum.alamat,
  telepon: props.umum.telepon,
  email: props.umum.email,
})

const sosmed = useForm({
  facebook: props.sosmed.facebook,
  instagram: props.sosmed.instagram,
  tiktok: props.sosmed.tiktok,
  twitter: props.sosmed.twitter,
})
</script>

<template>
  <AdminLayout :title="title">
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        {{ title }}
      </h1>
      <Card class="py-4">
        <h2 id="umum" class="mb-5 text-xl font-semibold text-gray-900 dark:text-white">
          Pengaturan Umum
        </h2>
        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
        <FormUmumSekolah :sekolah="umum" @submit="umum.post(route('admin.sekolah.simpan.umum'))" />
      </Card>
      <Card class="py-4">
        <h2 id="sosmed" class="mb-5 text-xl font-semibold text-gray-900 dark:text-white">
          Pengaturan Sosial Media
        </h2>
        <hr class="h-px my-3 bg-gray-200 border-0 dark:bg-gray-700">
        <FormSosmedSekolah :sekolah="sosmed" @submit="sosmed.post(route('admin.sekolah.simpan.sosmed'))" />
      </Card>
    </div>
  </AdminLayout>
</template>