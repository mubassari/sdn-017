<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormArtikel } from "~Components/forms"
import { useForm } from "@inertiajs/vue3";
import { ref } from 'vue';

let title = ref('Tambah Artikel');

const artikel = useForm({
  judul: '',
  sampul: null,
  isi: '',
  kategori_id: 0,
})

</script>

<template>
  <AdminLayout :title="title">
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
    </div>
    <Card>
      <FormArtikel :artikel="artikel" @submit="artikel.post(route('admin.artikel.simpan'))" />
    </Card>
  </AdminLayout>
</template>