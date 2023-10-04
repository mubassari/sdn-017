<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormArtikel } from "~Components/forms"
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from 'vue';

let title = ref('Ubah Artikel');

const props = defineProps({ artikel: { type: Object, required: true } })

const artikel = useForm({
  id: props.artikel.id,
  judul: props.artikel.judul,
  sampul: props.artikel.sampul,
  isi: props.artikel.isi,
  kategori_id: props.artikel.kategori_id,
})

</script>

<template>
  <Head :title="title" />
  <AdminLayout>
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
    </div>
    <Card>
      <FormArtikel :artikel="artikel" @submit="artikel.post(route('admin.artikel.perbarui', artikel.id))" />
    </Card>
  </AdminLayout>
</template>