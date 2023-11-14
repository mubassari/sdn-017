<script setup>
import { AdminLayout } from '~Layouts';
import { Card } from '~Components/core'
import { FormSambutanSekolah } from '~Components/forms'
import { useForm } from "@inertiajs/vue3";
import { ref } from '@vue/reactivity';

const title = ref('Sambutan Kepala Sekolah');

const props = defineProps({
  sambutan: { type: Object, required: true },
})

const sambutan = useForm({
  isi: props.sambutan.isi,
  kepala_sekolah_id: props.sambutan.kepala_sekolah_id,
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
      <Card id="sambutan" class="scroll-my-20">
        <FormSambutanSekolah :sekolah="sambutan" @submit="sambutan.post(route('admin.sambutan.simpan'))" />
      </Card>
    </div>
  </AdminLayout>
</template>