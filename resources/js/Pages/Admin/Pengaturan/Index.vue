<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from '~Components/core';
import { FormPengaturanArtikel, FormPengaturanTag } from '~Components/forms'
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Pengaturan Situs');

const props = defineProps({
  artikel: { type: Object, required: true },
  tag: { type: Object, required: true },
})

const artikel = useForm({
  max_artikel_terbaru: props.artikel.max_artikel_terbaru,
  max_artikel_terkait: props.artikel.max_artikel_terkait,
  max_artikel_kategori: props.artikel.max_artikel_kategori,
  max_artikel_pencarian: props.artikel.max_artikel_pencarian,
})

const tag = useForm({
  header: props.tag.header,
  footer: props.tag.footer,
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
      <Card id="artikel" title="Pengaturan Artikel" class="scroll-my-20">
        <FormPengaturanArtikel :pengaturan="artikel" @submit="artikel.post(route('admin.pengaturan.simpan_artikel'))" />
      </Card>
      <Card id="tag" title="Pengaturan Tag" class="scroll-my-20">
        <FormPengaturanTag :pengaturan="tag" @submit="tag.post(route('admin.pengaturan.simpan_tag'))" />
      </Card>
    </div>
  </AdminLayout>
</template>