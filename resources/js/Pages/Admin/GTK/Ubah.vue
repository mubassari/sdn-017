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
  sampul: props.gtk.sampul,
  gtk_jabatan_id: props.gtk.gtk_jabatan_id,
})

</script>

<template>
  <AdminLayout :title="title">
    <div class="w-full p-4">
      <h1 class="mb-3 text-xl font-semibold text-gray-900 sm:text-2xl dark:text-white">
        {{ title }}
      </h1>
    </div>
    <Card>
      <FormGTK :gtk="gtk" @submit="gtk.post(route('admin.gtk.perbarui', gtk.id))" />
    </Card>
  </AdminLayout>
</template>