<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormGTK } from "~Components/forms"
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Tambah GTK');

const gtk = useForm({
  nama: '',
  nip: '',
  jenis_kelamin: 0,
  foto: null,
  gtk_jabatan_id: 0,
})

</script>

<template>
  <AdminLayout :title="title">
    <div class="mb-4 col-span-full xl:mb-2">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        {{ title }}
      </h1>
    </div>
    <Card class="mb-4 col-span-full xl:mb-2">
      <FormGTK :gtk="gtk" @submit="gtk.post(route('admin.gtk.simpan'))" />
    </Card>
  </AdminLayout>
</template>