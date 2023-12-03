<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from "~Components/core"
import { FormGTK } from "~Components/forms"
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Ubah GTK');

const props = defineProps({ gtk: { type: Object, required: true } })

const gtk = useForm({
  id: props.gtk.id,
  nama: props.gtk.nama,
  nip: props.gtk.nip,
  tempat_lahir: props.gtk.tempat_lahir,
  tanggal_lahir: props.gtk.tanggal_lahir,
  jenis_kelamin: props.gtk.jenis_kelamin,
  foto: props.gtk.foto,
  status: props.gtk.status,
  gtk_jabatan_id: props.gtk.gtk_jabatan_id,
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
      <FormGTK :gtk="gtk" @submit="gtk.put(route('admin.gtk.perbarui', gtk.id))" />
    </Card>
  </AdminLayout>
</template>