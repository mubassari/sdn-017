<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from '~Components/core';
import { FormPengaturanArtikel } from '~Components/forms'
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Pengaturan Situs');

const props = defineProps({
  artikel: { type: Object, required: true },
})

const artikel = useForm({
  max_artikel_terbaru: props.artikel.max_artikel_terbaru,
  max_artikel_terkait: props.artikel.max_artikel_terkait,
  max_artikel_kategori: props.artikel.max_artikel_kategori,
  max_artikel_pencarian: props.artikel.max_artikel_pencarian,
})
</script>
<template>
  <AdminLayout :title="title">
    <div class="mb-4 col-span-full xl:mb-2">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        {{ title }}
      </h1>
    </div>
    <div class="col-span-full">
      <Card id="artikel" class="scroll-my-20">
        <h2 class="mb-5 text-xl font-semibold text-gray-900 dark:text-white">
          Pengaturan Artikel
        </h2>
        <FormPengaturanArtikel :pengaturan="artikel" @submit="artikel.post(route('admin.pengaturan.simpan_artikel'))" />
      </Card>
    </div>
  </AdminLayout>
</template>