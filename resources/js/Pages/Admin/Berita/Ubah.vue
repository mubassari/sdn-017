<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormBerita } from "~Components/forms"
import { Head, useForm } from "@inertiajs/vue3";
import { ref } from 'vue';

let title = ref('Tambah Berita');

const props = defineProps({ berita: { type: Object, required: true } })

const berita = useForm({
  id: props.berita.id,
  judul: props.berita.judul,
  sampul: props.berita.sampul,
  isi: props.berita.isi,
})

</script>

<template>
  <Head :title="title" />
  <AdminLayout>
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">{{ title }}</h1>
    </div>
    <Card>
      <FormBerita :berita="berita" @submit="berita.post(route('admin.berita.perbarui', berita.id))" />
    </Card>
  </AdminLayout>
</template>